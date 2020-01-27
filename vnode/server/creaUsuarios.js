var Usuario = require('./modelUsuarios.js')

module.exports.crearUsuarioDemo = function(callback){
  var arr = [{ email: 'us01@gmail.com', user: "us01", password: "123456"}, { email: 'demo@gmail.com', user: "demo", password: "123456"}]; 
  Usuario.insertMany(arr, function(error, docs) { 
    if (error){ 
      if (error.code == 11000){
        callback("Utilice los siguientes datos: </br>usuario: us01 | password:123456 </br>usuario: demo | password:123456") 
      }else{
        callback(error.message)
      }
    }else{
      callback(null, "El usuario 'us01' y 'demo' se ha registrado correctamente. </br>usuario: us01 | password:123456 </br >usuario: demo | password:123456") 
    }
  });
}
