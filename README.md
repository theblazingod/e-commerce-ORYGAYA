# [Orygaya Ecommerce](https://www.orygaya.org.uk) ![Open Source Love](https://img.shields.io/badge/Open%20Source-%E2%9D%A4-red.svg)

![](https://img.shields.io/badge/PHP-8.3-informational?style=flat&logo=php&color=4f5b93)
![](https://img.shields.io/badge/Laravel-11-informational?style=flat&logo=laravel&color=ef3b2d)
![](https://img.shields.io/badge/JavaScript-ECMA2020-informational?style=flat&logo=JavaScript&color=F7DF1E)
![](https://img.shields.io/badge/Livewire-3.5-informational?style=flat&logo=Livewire&color=fb70a9)
![](https://img.shields.io/badge/Filament3.3-informational?style=flat&logo=data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0OCIgaGVpZ2h0PSI0OCIgeG1sbnM6dj0iaHR0cHM6Ly92ZWN0YS5pby9uYW5vIj48cGF0aCBkPSJNMCAwaDQ4djQ4SDBWMHoiIGZpbGw9IiNmNGIyNWUiLz48cGF0aCBkPSJNMjggN2wtMSA2LTMuNDM3LjgxM0wyMCAxNWwtMSAzaDZ2NWgtN2wtMyAxOEg4Yy41MTUtNS44NTMgMS40NTQtMTEuMzMgMy0xN0g4di01bDUtMSAuMjUtMy4yNUMxNCAxMSAxNCAxMSAxNS40MzggOC41NjMgMTkuNDI5IDYuMTI4IDIzLjQ0MiA2LjY4NyAyOCA3eiIgZmlsbD0iIzI4MjQxZSIvPjxwYXRoIGQ9Ik0zMCAxOGg0YzIuMjMzIDUuMzM0IDIuMjMzIDUuMzM0IDEuMTI1IDguNUwzNCAyOWMtLjE2OCAzLjIwOS0uMTY4IDMuMjA5IDAgNmwtMiAxIDEgM2gtNXYyaC0yYy44NzUtNy42MjUuODc1LTcuNjI1IDItMTFoMnYtMmgtMnYtMmwyLTF2LTQtM3oiIGZpbGw9IiMyYTIwMTIiLz48cGF0aCBkPSJNMzUuNTYzIDYuODEzQzM4IDcgMzggNyAzOSA4Yy4xODggMi40MzguMTg4IDIuNDM4IDAgNWwtMiAyYy0yLjYyNS0uMzc1LTIuNjI1LS4zNzUtNS0xLS42MjUtMi4zNzUtLjYyNS0yLjM3NS0xLTUgMi0yIDItMiA0LjU2My0yLjE4N3oiIGZpbGw9IiM0MDM5MzEiLz48cGF0aCBkPSJNMzAgMThoNGMyLjA1NSA1LjMxOSAyLjA1NSA1LjMxOSAxLjgxMyA4LjMxM0wzNSAyOGwtMyAxdi0ybC00IDF2LTJsMi0xdi00LTN6IiBmaWxsPSIjMzEyODFlIi8+PHBhdGggZD0iTTI5IDI3aDN2MmgydjJoLTJ2MmwtNC0xdi0yaDJsLTEtM3oiIGZpbGw9IiMxNTEzMTAiLz48cGF0aCBkPSJNMzAgMThoNHYzaC0ydjJsLTMgMSAxLTZ6IiBmaWxsPSIjNjA0YjMyIi8+PC9zdmc+&&color=fdae4b&link=https://filamentphp.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

[![Install](https://github.com/orygaya-ecommerce/ecommerce-laravel/actions/workflows/install.yml/badge.svg)](https://github.com/orygaya-ecommerce/ecommerce-laravel/actions/workflows/install.yml)
[![Tests](https://github.com/orygaya-ecommerce/ecommerce-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/orygaya-ecommerce/ecommerce-laravel/actions/workflows/tests.yml)
[![Docker](https://github.com/orygaya-ecommerce/ecommerce-laravel/actions/workflows/main.yml/badge.svg)](https://github.com/orygaya-ecommerce/ecommerce-laravel/actions/workflows/main.yml)

## [Managed Premium Hosting Service](https://orygaya.co.uk/order/main/packages/applications/?group_id=3)


## Our Projects

* https://github.com/orygaya-accounting/accounting-laravel
* https://github.com/orygaya-automation/automation-laravel
* https://github.com/orygaya-billing/billing-laravel
* https://github.com/orygaya-software/boilerplate
* https://github.com/orygaya-browser-game/browser-game-laravel
* https://github.com/orygaya-cms/cms-laravel
* https://github.com/orygaya-control-panel/control-panel-laravel
* https://github.com/orygaya-crm/crm-laravel
* https://github.com/orygaya-ecommerce/ecommerce-laravel
* https://github.com/orygaya-genealogy/genealogy-laravel
* https://github.com/orygaya-maintenance/maintenance-laravel
* https://github.com/orygaya-real-estate/real-estate-laravel
* https://github.com/orygaya-social-network/social-network-laravel


## Setup

1. Ensure your environment is set up with PHP 8.3 and Composer installed.
2. Download the project files from this GitHub repository.
3. Open a terminal in the project folder. If you are on Windows and have Git Bash installed, you can use it for the following steps.
4. Run the following command:

```bash
./setup.sh
```

and everything should be installed automatically if you are using Linux you just run the script as you normally run scripts in the terminal.

NOTE 1: The script will ask you if you want to have your .env be overwritten by .env.example, in case you have already an .env configuration available please answer with "n" (No).

NOTE 2: This script will run seeders, please make sure you are aware of this and don't run this script if you don't want this to happen.
```bash
composer install
php artisan key:generate
php artisan migrate --seed
```
This will install the necessary dependencies, generate an application key, and set up your database with initial data.

NOTE 3: Ensure your `.env` file is correctly configured with your database connection details before running migrations.

## Building with Docker

Alternatively, you can build and run the project using Docker. To build the Dockerfile, follow these steps:

1. Ensure you have Docker installed on your system.
2. Open a terminal in the project folder.
3. Run the following command to build the Docker image:
   ```
   docker build -t ecommerce-laravel .
   ```
4. Once the image is built, you can run the container with:
   ```
   docker run -p 8000:8000 ecommerce-laravel
   ```

NOTE 3: Ensure your `.env` file is correctly configured with your database connection details before running migrations.

### Using Laravel Sail

This project also includes support for Laravel Sail, which provides a Docker-based development environment. To use Laravel Sail, follow these steps:

1. Ensure you have Docker installed on your system.
2. Open a terminal in the project folder.
3. Run the following command to start the Laravel Sail environment:
   ```
   ./vendor/bin/sail up
   ```
4. Once the containers are running, you can access the application at `http://localhost`.
5. To stop the Sail environment, press `Ctrl+C` in the terminal.

For more information on using Laravel Sail, refer to the [official documentation](https://laravel.com/docs/sail).

### Description

Welcome to Orygaya Ecommerce, our visionary open-source project that revolutionizes the world of online commerce by harnessing the capabilities of Laravel 11, PHP 8.3, Livewire 3, and Filament 3. Orygaya Ecommerce is not just a platform for buying and selling; it's an innovative solution designed to provide a seamless and dynamic shopping experience for businesses and consumers alike.

**Key Features:**

1. **Intuitive Shopping Experience:** Orygaya Ecommerce offers a user-friendly and intuitive shopping interface, ensuring that customers can browse, select, and purchase products with ease. From product discovery to checkout, our project is crafted to enhance the entire shopping journey.

2. **Dynamic Livewire Interactions:** Built on Laravel 11 and PHP 8.3, Orygaya Ecommerce integrates Livewire 3 for dynamic and real-time interactions. Enjoy a responsive and interactive shopping experience as you explore product details, add items to your cart, and complete transactions effortlessly.

3. **Efficient Admin Panel:** Filament 3, our admin panel built on Laravel, provides administrators with powerful tools to manage products, customize settings, and oversee the entire ecommerce ecosystem. From inventory management to order fulfillment, Orygaya Ecommerce ensures efficient and streamlined operations.

4. **Secure Payment Processing:** Orygaya Ecommerce prioritizes security in online transactions. Our project supports secure payment gateways, protecting both customers and businesses from potential threats and ensuring a trustworthy ecommerce environment.

5. **Customizable Templates:** Tailor your online store's appearance with customizable templates. Orygaya Ecommerce offers flexibility in design, allowing businesses to create a unique and visually appealing storefront that aligns with their brand identity.

Orygaya Ecommerce is open source, released under the permissive MIT license. We invite developers, businesses, and ecommerce enthusiasts to contribute to the evolution of online commerce. Together, let's redefine the standards of ecommerce platforms and create a dynamic space where businesses thrive and customers enjoy a seamless shopping experience.

Welcome to Orygaya Ecommerce – where innovation meets commerce, and the possibilities of online retail are limitless. Join us on this journey to transform the way we buy and sell in the digital age.

### Licensed under MIT, use for any personal or commercial project.
  
## Key Features (Planned and In Development):

* Modular Architecture: Ecommerce is designed with a modular architecture, enabling developers to create, integrate, and manage components seamlessly. Each module encapsulates specific functionalities, promoting code reusability and maintainability.
* Customizable Themes: The platform will offer a variety of customizable themes, allowing businesses to create unique and visually appealing online stores that align with their brand identity.
* Responsive Design: Ensuring an optimal user experience across various devices and screen sizes, Ecommerce emphasizes a responsive design approach, enhancing accessibility and usability.
* Advanced Search and Filtering: The system will incorporate advanced search and filtering capabilities, empowering users to easily find the products they desire within the extensive product catalog.
* Secure Payment Integration: Integration with secure payment gateways will be a fundamental feature, ensuring a seamless and secure checkout process for customers.
* Inventory Management: Comprehensive inventory management features will be provided, enabling businesses to efficiently track, manage, and update their product inventory.
* Order Processing and Management: Streamlining order processing and management, the platform will allow businesses to handle orders, track shipments, and manage returns effortlessly.
* Customer Accounts and Profiles: Customers will have the ability to create accounts, manage their profiles, track orders, and receive personalized recommendations based on their preferences and purchase history.
* Multi-language and Multi-currency Support: Ecommerce will support multiple languages and currencies, enabling businesses to reach a global audience and conduct transactions in their preferred language and currency.
* SEO Optimization: To enhance online visibility, the platform will incorporate SEO-friendly features, optimizing content and product listings for search engines.

## Community Involvement: 
Ecommerce is committed to building a vibrant community of developers, designers, and eCommerce enthusiasts. Contributions, feedback, and collaboration from the community are highly encouraged to make this project a powerful, flexible, and feature-rich eCommerce solution.

Join us in revolutionizing the eCommerce landscape with Ecommerce – where flexibility, modularity, and innovation meet to create the ultimate online shopping experience.

## Contributions
We warmly welcome new contributions from the community! We believe in the power of collaboration and appreciate any involvement you'd like to have in improving our project. Whether you prefer submitting pull requests with code enhancements or raising issues to help us identify areas of improvement, we value your participation.

If you have code changes or feature enhancements to propose, pull requests are a fantastic way to share your ideas with us. We encourage you to fork the project, make the necessary modifications, and submit a pull request for our review. Our team will diligently review your changes and work together with you to ensure the highest quality outcome.

However, we understand that not everyone is comfortable with submitting code directly. If you come across any issues or have suggestions for improvement, we greatly appreciate your input. By raising an issue, you provide valuable insights that help us identify and address potential problems or opportunities for growth.

Whether through pull requests or issues, your contributions play a vital role in making our project even better. We believe in fostering an inclusive and collaborative environment where everyone's ideas are valued and respected.

We look forward to your involvement, and together, we can create a vibrant and thriving project. Thank you for considering contributing to our community!

## License
This project is licensed under the MIT license, granting you the freedom to utilize it for both personal and commercial projects. The MIT license ensures that you have the flexibility to adapt, modify, and distribute the project as per your needs. Feel free to incorporate it into your own ventures, whether they are personal endeavors or part of a larger commercial undertaking. The permissive nature of the MIT license empowers you to leverage this project without any unnecessary restrictions. Enjoy the benefits of this open and accessible license as you embark on your creative and entrepreneurial pursuits.

## Contributors


<a href = "https://github.com/orygaya-ecommerce/ecommerce-laravel/graphs/contributors">
  <img src = "https://contrib.rocks/image?repo=orygaya-ecommerce/ecommerce-laravel"/>
