const RouterEventos = require('express').Router();
const Usuario = require('./modeloDeUsuarios.js')
//modelo eventos
const Evento = require('./modeloDeEventos.js') 
const Operaciones = require('./creaUsuarios.js')
let ObjectId = require('mongoose').Types.ObjectId;


RouterEventos.all('/', function(req, res) {
  res.send('error.  verifique la  url a la cual desea acceder' )
  res.end()
})



// Eliminar un evento 
RouterEventos.post('/delete/:_id', function(req, res) {
  let id = req.params._id 
  req.session.reload(function(err) {
    if(err){
      console.log(err) 
      res.send("logout")
    }else{
      Evento.remove({_id: id}, function(error) {
        if(error) {
          console.log(error) 
          res.status(500)
          res.json(error)
        }
        res.send("Registro Borrado") 
      })
    }
  })
})

//Modificar evento
//Obtener el identificador, fecha de inicio y final del evento  digitados en el formulario
RouterEventos.post('/update/:_id&:start&:end', function(req, res) { 
  req.session.reload(function(err) {
    if(err){
      console.log(err)
      res.send("logout") 
    }else{
		//buscar el eventoi
      Evento.findOne({_id:req.params._id}).exec((error, result) => { 
        let id    = req.params._id, 
        start = req.params.start, 
        end   = req.params.end 
        if (error){ 
          res.send(error)
        }else{
			 //Ejecutar la  modificacion del evento
          Evento.update({_id: id}, {start:start, end:end}, (error, result) => {
            if (error){ 
              res.send(error )
            }else{
              res.send("Evento MOdificado") 
            }
          })
        }
      })
    }
  })
})

// Busca los ebventos por usario
RouterEventos.get('/all', function(req, res) {
	//recupera sesion
  req.session.reload(function(err) { 
    //valida sesión iniciada
    if(req.session.user){ 
      if(err){
        res.send('logout');
        res.end()
      }else{
        Usuario.findOne({user:req.session.user}).exec({}, function(error, doc){
          if(error){
            res.send('logout'); 
          }else{
			 // buvcar todos los registros de eventos del usario
            Evento.find({user: doc._id}).exec(function(err, doc){ 
              if (err) {
                res.status(500)
                res.json(err)
              }
			  //devuleve informacion encontrada en formato json
              res.json(doc) 
            })
          }
        })
      }
    }else{ 
	//El usario no ha inicado sesion
	res.send('logout'); 
      res.end()
    }
  })
})

// Creacion De eventos
RouterEventos.post('/new', function(req, res) {
	//Obtener datos de la sesion guardada
  req.session.reload(function(err) { 
    if(err){
      console.log(err); 
      res.json("logout"); 
    }else{
      Usuario.findOne({user:req.session.user}).exec({}, function(error, doc){
		   //obtener el valor del último registro guardado en el modelo Evento
        Evento.nextCount(function(err, count) {
          newID = count
        });
		
         //asigna el valor del titulo del formulario
        let title = req.body.title,
		//inicio del evento
        start = req.body.start, 
		//fin del evento
        end   = req.body.end, 
        userId  = doc._id 

        let evento = new Evento({ 
          title: title,
          start: start,
          end: end,
          user: userId
        })
        evento.save(function(error) { 
		//registra en base de datos
          if (error) {
            console.log(error) 
            res.json(error) 
          }
		  //dvuelve el ultimo id
          res.json(newID) 
        })
      })
    }
  })

})

module.exports = RouterEventos 
