# TYPO3 form_fieldnames extension for the Anyrel Framework

Adds a **Form Field Names** section to the Anyrel backend module, showing which form
elements still need a field name and filling them in.

## Background

[`mediatis/form_fieldnames`](https://github.com/mediatis/form_fieldnames) adds a
required, form-unique **Name** to every TYPO3 form element, separate from the
translatable label. Anyrel reads that name as the stable identifier for data mapping.

When an existing project starts using Anyrel, none of its form elements have one yet,
and the form editor reports a validation error for each of them. That extension ships
a `form:fieldnames` CLI command to derive names from the labels; this package puts the
same thing in the backend, for people who do not work on the command line.

## Requirements

- TYPO3 12.4, 13.4 or 14.x
- PHP 8.2 or newer
- `digital-marketing-framework/typo3-core` and `mediatis/form_fieldnames`

## Installation

```bash
composer require digital-marketing-framework/typo3-form-fieldnames
```

## Usage

The section appears in the Anyrel backend module as **Form Field Names**. It lists
every form that has elements without a name, together with the name that would be
generated for each, and flags problems that cannot be resolved automatically — forms in
read-only storage, unparsable definitions, duplicate names set by hand, and form
identifiers used by more than one form.

Nothing is written until you press a button:

- **Fill in these names** writes the missing names of one form
- **Fill in all missing names** does the same for every listed form, and only appears
  when more than one form is affected

An existing name is never overwritten, and a form that is already complete is not
listed. Review the generated names afterwards — they are derived from the labels as a
starting point, not a substitute for deciding what a field should be called.

Flush the frontend caches afterwards so pages embedding the changed forms are rebuilt.

The naming rules — snake_case, umlaut transliteration, `LLL:` labels resolved against
the default language, identifier fallback, numeric suffixes for collisions — are
documented in `mediatis/form_fieldnames`, which implements them.

## Development

```bash
composer ci        # all checks
composer ci:static # style, types and linting only
composer fix       # apply rector and php-cs-fixer
```

## License

GPL-2.0-or-later
