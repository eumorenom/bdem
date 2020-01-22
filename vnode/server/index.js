
const http = require('http');
//Manjar directorios 
      path = require('path'),
	  //para enruamiento de peticiones
      express = require('express'), 
	  //manejo de sesiones
      session = require('express-session'),
	//manejo del formato jason	  
      bodyParser = require('body-parser');
	  
      MongoClient = require('mongodb').MongoClient, 
      mongoose = require('mongoose'),
      
	     connection = mongoose.connect('mongodb://localhost/bd_agenda', {useMongoClient: true}, function(error){
			 
           if(error){

           	 console.log(error.name +" "+ error.message);
           }else{
              console.log('Conectado a MongoDB'); //Mostrar mensaje exitoso
           }
        });


const RoutingUsers = require('./adminUsuarios.js'), 
      RoutingEvents = require('./adminEventos.js') 

const PORT = 3000
const app = express() 

//crear servidor http
const Server = http.createServer(app)

//el directorio raiz es cliente
app.use(express.static('../client')) 
//incio el modiulo para parsear en formato json
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended: true}))
//modulo de manejo de sesiones
app.use(session({ 
    //Gen de caracteres para  Identificador de la sesión cookie

    secret: 'secret-pass', 
	//mantener las los cookies por dos horas
    cookie: { maxAge: 7200000 }, 
    resave: false,
    saveUninitialized: true,
  }));

app.use('/usuarios', RoutingUsers) 
app.use('/events', RoutingEvents) 

//Iniciar el servidor http
Server.listen(PORT, function() { 
  console.log('Server is listening on port: ' + PORT) 
})
