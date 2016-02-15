# Backend Admin Menu

Extends the contao backend with a menu containing useful shortcuts.

![alt Preview](docs/screenshot.jpg)

*Preview*

## Features

### Currently available actions

- regenerate the internal cache

### Hooks

Name | Arguments | Expected return value | Description
---- | --------- | --------------------- | -----------
addBackendAdminMenuEntry | $strEntryTemplate, $objBackendAdminMenu | A parsed action as string or *false* | Triggered just before the menu template is parsed