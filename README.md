# SuluMediaCreditsBundle

[![Packagist Version](https://img.shields.io/packagist/v/perspeqtive/sulu-media-credits-bundle)](https://packagist.org/packages/perspeqtive/sulu-media-credits-bundle)

The Sulu Media Credits Bundle enables the automatic listing of media credits for media used on the current page. It scans the content of the current page for linked media and provides them collectively for display.

## 🚀 Features

*   **Automatic Detection:** Detects media references in various content types.
*   **Centralized Display:** Collects all media credits of the current page in one place (e.g., in the masthead).
*   **Additional Info:** Considers copyright information and credit fields from media metadata.
*   **Linking:** Provides links to the pages where the media is used (if applicable).

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

The bundle provides a Twig function that returns a collection of all media references on the current page.

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

| Property | Type | Description |
| :--- | :--- | :--- |
| `title` | `string` | Title of the linked page/resource |
| `url` | `string` | URL to the resource |

## ⚠️ Caution:

Only images directly used in page-types are considered for reference linking. When using snippets or custom entities, the references are not returned. The credit and copyright information is still available.

## 👩‍🍳 Contribution

Please feel free to fork and extend existing or add new features and send a pull request with your changes! To establish a consistent code quality, please provide unit tests for all your changes and adapt the documentation.
