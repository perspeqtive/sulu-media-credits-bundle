# SuluMediaCreditsBundle

[![Packagist Version](https://img.shields.io/packagist/v/perspeqtive/sulu-media-credits-bundle)](https://packagist.org/packages/perspeqtive/sulu-media-credits-bundle)

The Sulu Media Credits Bundle enables the automatic listing of media credits for media used on the current website. It scans the content via the reference bundle of the current website for linked media and provides them collectively for display.

## 🚀 Features

*   **Automatic Detection:** Detects media references in various content types.
*   **Centralized Display:** Collects all media credits of the current page in one place (e.g., in the masthead).
*   **Additional Info:** Considers copyright information and credit fields from media metadata.
*   **Memory Optimization:** Uses generators to reduce memory usage.
*   **Linking:** Provides links to the pages where the media is used (if applicable).
*   **Extendable:** Easily add your own logic for additional content types.

## 🛠️ Installation

### Install the bundle via composer:

```bash
composer require perspeqtive/sulu-media-credits-bundle
```

### Activate the bundle

If you are not using symfony flex, register it in your `config/bundles.php`:

```php
return [
    // ...
    PERSPEQTIVE\MediaCreditsBundle\MediaCreditsBundle::class => ['all' => true],
];
```

## 🛠️ Usage

The bundle provides a Twig function that returns a collection of all media references on the current website.

### Twig Function

Use `media_credits()` to retrieve the credits collection.

```twig
{% set credits = media_credits() %}

{% if credits.hasCredits %}
    <section class="media-credits">
        <h3>Media Credits</h3>
        <ul>
            {% for item in credits %}
                <li>
                    <strong>{{ item.title }}</strong>
                    {% if item.credit %}- {{ item.credit }}{% endif %}
                    {% if item.copyright %}(&copy; {{ item.copyright }}){% endif %}
                    
                    {% if item.references %}
                        Used in:
                        <ul class="references"> 
                            {% for ref in item.references.next %}
                                <li><a href="{{ ref.url }}" target="_blank">{{ ref.title }}</a></li>
                            {% endfor %}
                        </ul>
                    {% endif %}
                </li>
            {% endfor %}
        </ul>
    </section>
{% endif %}
```

### Data Structure

The `media_credits()` function returns a `CreditsCollection` object, which iterates over `Credits` objects.

| Property     | Type                       | Description                                       |
|:-------------|:---------------------------|:--------------------------------------------------|
| `mediaId`    | `int`                      | The ID of the medium                              |
| `title`      | `string`                   | The title/name of the medium                      |
| `copyright`  | `string`                   | The copyright field from the metadata             |
| `credit`     | `string`                   | The credit field from the metadata                |
| `references` | `MediaReferenceCollection` | Collection of references where the file is linked |

Within `item.references.next` (MediaReference):

| Property     | Type | Description                                        |
|:-------------| :--- |:---------------------------------------------------|
| `title`      | `string` | Title of the linked page/resource                  |
| `resourceId` | `string` | The target resources unique identifier             |
| `resourceType`      | `string` | The target resource key like 'pages' or 'articles' |
| `url`        | `string` | URL to the resource                                |

## ⚠️ Caution:

Only images directly used in page-types are considered for reference linking. When using snippets or custom entities, the references are not returned. The credit and copyright information is still available.

## 🛠️ Extending the Bundle

If you want to support additional media references (e.g., from custom entities or snippets), you can extend the bundle by implementing two interfaces.

### 1. Implement `ReferenceByTypeRepositoryInterface`

This interface is responsible for finding references for a specific media ID.

```php
namespace App\Repository;

use PERSPEQTIVE\MediaCreditsBundle\Domain\References\ReferenceByTypeRepositoryInterface;

class MyCustomReferenceRepository implements ReferenceByTypeRepositoryInterface
{
    public function findReferences(string $mediaId): iterable
    {
        // Your logic to find references for the given mediaId
        // Should return an iterable of arrays with the following keys:
        // 'referenceTitle', 'referenceResourceId', 'referenceResourceKey', 'referenceLocale'
        yield [
            'referenceResourceId' => '123',
            'referenceResourceKey' => 'my_custom_type',
            'referenceTitle' => 'My Custom Entity Title',
            'referenceLocale' => 'en',
        ];
    }
}
```

### 2. Implement `UrlRepositoryByTypeInterface`

This interface is responsible for generating the URL for a found reference.

```php
namespace App\Repository;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Url\UrlRepositoryByTypeInterface;

class MyCustomUrlRepository implements UrlRepositoryByTypeInterface
{
    public function find(string $id, string $locale): ?string
    {
        // Generate the URL for your custom entity
        return '/de/my-custom-entity/' . $id;
    }

    public function isResponsible(string $type): bool
    {
        return $type === 'my_custom_type';
    }
}
```

### 3. Register the Services

The bundle uses [tagged iterators](https://symfony.com/doc/current/service_container/tags.html#reference-tagged-services) to collect all repositories.

#### Via Autowire & Autoconfigure

If your application uses `autoconfigure: true`, the services will be registered automatically because the bundle registers the interfaces for autoconfiguration.

```yaml
# config/services.yaml
services:
    _defaults:
        autowire: true
        autoconfigure: true

    App\Repository\MyCustomReferenceRepository: ~
    App\Repository\MyCustomUrlRepository: ~
```

#### Manual Registration

If you don't use autoconfigure, you must add the tags manually:

```yaml
# config/services.yaml
services:
    App\Repository\MyCustomReferenceRepository:
        tags:
            - { name: 'perspeqtive.media_credits.reference_finder_repository' }

    App\Repository\MyCustomUrlRepository:
        tags:
            - { name: 'perspeqtive.media_credits.url_repository' }
```

## 👩‍🍳 Contribution

Please feel free to fork and extend existing or add new features and send a pull request with your changes! To establish a consistent code quality, please provide unit tests for all your changes and adapt the documentation.
