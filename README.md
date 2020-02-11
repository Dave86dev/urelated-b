
#

#### Table of Contents  

- [How to run 🚀](#How-to-run-)  
- [DB 💾](#DB-) 
- [Backend 🔙](#Backend-) 
	- [User endpoints](#USER)
	- [Product endpoints](#MOVIE)

- [Frontend 👁‍🗨](#Frontend-)  

#



<br>

# ¿Qué es? 👀

Es un portal de empleo creado y diseñador por [Rubén Viosquez Beades](https://github.com/rubeneitor) y [David Ochando Blasco](https://github.com/Dave86dev/) que usa:

- Frontend: 🌌 React 16 + Redux
- Backend: 🔸 PHP Laravel 
- DB: 🍃 MySQL 

Durante el desarrollo hemos usado [este tablón de Trello](https://trello.com/b/OY1doF76/urelated).


<br>

# Cómo lanzarlo 🚀

- Descargar [Repositorio Backend](https://github.com/Dave86dev/urelated-b).
- Descargar [Repositorio Frontend](https://github.com/rubeneitor/urelated-f)
- En el the backend ejecutar:
	- `php artisan serve`
- En el the frontend ejecutar:
	- `npm start`
- Debería abrirse en http://localhost:3000/


<br>

# DB 💾

Esquema DB
![](https://trello-attachments.s3.amazonaws.com/5e1f91537a519b60467910d8/1183x825/5e51f9d802a14358f11d9476697db190/b069e56af23f426d8c03c1f91c63acde.png)


<br>

# Backend 🔙

## **Endpoints** 📃

## USER

- Register
	- **POST** /registerU
```json
{
	"name": "usuario",
	"surname": "prueba",
	"email":  "usuarioprueba@gmail.com",
	"picture": "https://s3-us-west-2.amazonaws.com/thecoderlist/testing/coder-man-profile-pic.png",
	"phone": "123456789",
	"password":  "12345",
	"secretQ": "hola",
	"secretA": "adios",
	"ciudad": "Mislata",
	"provincia": "Valencia",
	"pais": "España"
}
```

- Login
	- **POST** /loginU
```json
{
	"email":  "usuarioprueba@gmail.com",
	"password":  "12345"
}
```

- Logout
	- **POST** /logOutU
	
- Get user profile
	- **GET** /perfilU/{id}


## BUSINESS

- Register
	- **POST** /registerE
```json
{
	"name_reg": "empresa",
	"surname_reg": "prueba",
	"name": "empresaprueba",
	"email":  "empresaprueba@gmail.com",
	"picture": "https://www.lafabricadebordados.es/2783-large_default/parche-bordado-mercedes-benz.jpg",
	"password":  "12345",
	"secretQ": "hola",
	"secretA": "adios",
	"phone": "123456789",
	"description": "Empresa dedica a la marca mercedes y al desarrollo de sus webs",
	"sector": "software"
}
```

- Login
	- **POST** /loginE
```json
{
	"email":  "empresaprueba@gmail.com",
	"password":  "12345"
}
```

- Logout
	- **POST** /logOutE
	
- Get user profile
	- **GET** /perfilE/{id}






<br>

# Frontend 👁‍🗨

## Features 📃

- Homepage:
	- Vista principal con ofertas destacadas de diferentes ambito y motor de busqueda
	![](https://trello-attachments.s3.amazonaws.com/5e1f2afd48fcff536d5f0134/5e2c072828afd87ca27ebe72/464b88ab9267918b05967d0d486989f3/d52c81a3205b765097693bb73b27d3d0.png)
	
- Búsqueda
	- Pulsando sobre la lupa se puede hacer una búsqueda vacía, mostrando todos los productos.
	- Filtros:
		- Palabra clave
		- Rango salarial
		- Años de experiencia
		- Tipo de jornada
	- Orden
		- Fecha
	![](https://i.gyazo.com/0d18a9e97158e40b8626e2c730b4deff.png)

- Ofertas
	- Detalle
		- Ordenadas por fecha
		![](https://i.gyazo.com/c1a20e45ec1bc4024409dcee1fe16843.png)
	
- Usuarios
	- Login
	![](https://i.gyazo.com/14e854eab0ceed98f52b1936a90fffe0.png)
	
	- Register
		- Primer paso:
	![](https://i.gyazo.com/929c2db7532a84df5d888b4c41b3f5c1.png)
		- Segundo paso:
	![](https://i.gyazo.com/ec542d80d5b288f180843136473d5c64.png)

		-Tercer y ultimo paso:
	![](https://i.gyazo.com/6fed2f25ce5c25535564e8a58fbc6a20.png)
	
	- Password reset
		- Primer paso:
	![](https://i.gyazo.com/a2bbbb531428c2c6e9408f9dc2eda959.png)
		- Segundo paso:
	![](https://i.gyazo.com/ef7b52b1b320ee583fbde7dcb6a21481.png)


	
	- Perfil
	![](https://i.gyazo.com/9a64f2c3690ee5666a98ad3615c15c2f.png)

	- Curriculum
	![](https://i.gyazo.com/6c359e97b45a940feaf7df75acac596b.png)

	- Candidaturas
	![](https://i.gyazo.com/e775572a93d8ca391e6257f2e6700a31.png)

- Empresas 
	- Login
	![](https://i.gyazo.com/f81c70fb94198a97fa1beae710068cec.png)

	- Register 
		- Primer paso
		![](https://i.gyazo.com/2f28108ed57e614aaa05583eb7ea02a2.png)

		- Segundo y ultimo paso 
		![](https://i.gyazo.com/0c33734b0bedce71ea31f70eaafe0941.png)

	- Password reset
		- Primer paso
	    ![](https://i.gyazo.com/a21e693c558bb1753a55c6753cbf21f1.png)

		- Segundo paso
		![](https://i.gyazo.com/657dea32b8afbe51e28d66347ace16ef.png)

	- Perfil 
	![](https://i.gyazo.com/72ede28e53a282d46f932eebdf62481a.png)

	- Ofertas
	![](https://i.gyazo.com/4db2167e1ad36b29cf134077b670fb23.png)

	- Camabiar candidatura
	![](https://i.gyazo.com/bf6b80a16471f918f356f943d93dddfc.png)
	

<br>

# [🡅 TOP 🡅](#Table-of-Contents)  
