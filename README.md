## Run the Docker Image

Build:  `docker build -t my-apache .`
Run:    `docker run -dit --name apache-server -p 8080:80 my-apache`
Access: [http://localhost:8080/](http://localhost:8080/)

## Sensitive Information

Put sensitive information like connection strings, passwords, etc. in the env.php file. This file is not included in the repository. You can create it by copying the env.php.example file and filling in the values. (not sure about that system yet tho)

## Component-like Structure

To apply the DRY (Don't Repeat Yourself) principle, the code is structured in components. Each page should use the layout by declaring a `renderPage())` function that returns the HTML content. The layout is defined in the `layout.php` file.