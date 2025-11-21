# Boilerplate

There is no development server. You can use [Larvel Valet](https://laravel.com/docs/9.x/valet) or [MAMP](https://www.mamp.info/de/mac/) to view the site on your machine.

> **Warning**
> Do not update any dev depedencies in your project. There may be breaking changes. Always use this repository as the latest version.

## Features

- Parcel
- Tailwind (with [rfs](https://github.com/twbs/rfs) and [tailwindcss-bg-svg](https://github.com/AndersNielsen85/tailwindcss-bg-svg))
- ESLint
- Prettier

## Installation

1. Install the following VSCode extensions

- [Prettier](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode)
- [stylelint](https://marketplace.visualstudio.com/items?itemName=stylelint.vscode-stylelint)
- [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint)
- [Tailwind CSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss)

1. Install all dependencies:

```bash
npm i
```

Start development:

```bash
npm run dev
```

Start production build (in case there is no CI/CD):

```bash
npm run build
```

Delete all files in /dist/:

```bash
npm run clean
```

## Projects with Tailwind

- [Schauer & Co](https://github.com/seitenweise/schauer-co)
- [Container xChange](https://github.com/seitenweise/xchange)
- [valantic](https://github.com/seitenweise/valantic) (WIP)

## Todo

- npm package?
- test deployment via GitHub actions
