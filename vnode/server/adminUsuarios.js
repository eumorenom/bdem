//
const Router = require('express').Router();
const Usuarios = require('./modeloDeUsuarios.js')
const Eventos = require('./modeloDeEventos.js')
const Operaciones = require('./creaUsuarios.js')




//Verificar si el usario deo esta definido
Router.get('/demo', function(req, res) {
  Usuarios.find({user: req.query.user}).count({}, function(err, count) { 
    if(count>0){ 
        res.send("Use los siguientes usarios: </br>usuario: demo  | password:123456 </br>usuario: us01 | password:123456") 
		
    }else{
		 //Valida que no existyan eventos 
      Eventos.find({}).count({}, function(err, count) {
		 
		  if(count>0){ 
		     //Si Hay eventos
		 Eventos.remove({},function(err, doc){
          if(err){
            console.log(err)
          }else{
            console.log("Información de eventos reinicializada") 
          }
        })
      }
    })
	//crear usario demo
      Operaciones.crearUsuarioDemo((error, result) => { 
        if(error){
          res.send(error) 
        }else{
          res.send(result)
        }
      })
    }
  })
})

//Validar formulario
Router.post('/login', function(req, res) {
	//capturar el usario desde el formulario
    let user = req.body.user 
	//capturar el pw desde el formulario
    let password = req.body.pass, 
	 //Manejar sesiones
    sess = req.session;
	//Verificar si el usario ya existe
    Usuarios.find({user: user}).count({}, function(err, count) { 
        if (err) {
            res.status(500)
            res.json(err) 
        }else{
          if(count == 1){ 
		  //valida contraseña
            Usuarios.find({user: user, password: password }).count({}, function(err, count) { 
                if (err) {
                    res.status(500) 
                    res.json(err) 
                }else{
					
                  if(count == 1){
					  //actualizacion de la session
                    sess.user = req.body.user; 
                    res.send("Validado") 
                  }else{
					  //Caso de que la contraseña sea errada
                    res.send("Contraseña Errada") 
                  }
                }
            })
          }else{
            res.send("Usuario no encontrado") 
          }
        }

    })
})

//Validar formulario de inicio de sesion
Router.post('/logout', function(req, res) {
  req.session.destroy(function(err) {
  if(err) {
    console.log(err);
    res.json(err) 
  } else {
	  //Borrar cookies e ir alogout
    req.session = null 
    res.send('logout') 
    res.end()
  }
  });
});

Router.all('*', function(req, res) {
  res.send('Error Por favor verifique la dirección url ' )
  res.end()
})



module.exports = Router 
