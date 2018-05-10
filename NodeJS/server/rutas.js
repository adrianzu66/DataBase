const Router = require('express').Router();
const User = require('./model/user.js');
const EventCalendar = require('./model/event.js');
var mongoose = require('mongoose');
var crypto = require('crypto');

function encriptar(user, pass) {
   // usamos el metodo CreateHmac y le pasamos el parametro user y actualizamos el hash con la password
   var hmac = crypto.createHmac('sha1', user).update(pass).digest('hex')
   return hmac
}

//Crea Usurio
Router.get('/CreateUser', function(req, res) {
  var user = new User({
      _id: new mongoose.Types.ObjectId(),
      userId: "usuario@gmail.com",
      name: "Adrian Zurita",
      password: "123456",
      status: "Activo"
  });
  user.password = encriptar(user.userId, '123456');
  user.save(function(error) {
      if (error) {
          res.status(500)
          res.json(error)
      }
      res.json(user);
  });

})


//Crea Evento
Router.get('/CreateEvent', function(req, res) {
  User.findOne({userId:"usuario@gmail.com"},function (err, user){
     if(user){
       var evento = new EventCalendar({
         _id: new mongoose.Types.ObjectId(),
         title: "Prueba",
         user: user.id,
         startDate: new Date('2018-05-01'),
         endDate: new Date('2018-05-01'),
         startHour: "15",
         endHour: "18"
       });
       evento.save(function(error) {
           if (error) {
               res.status(500)
               res.json(error)
           }
           res.json(evento);
       });
     }
   });

});

//valida usuario

Router.post('/login', function(req, res) {
   var username = req.body.username
   var password = req.body.password

   var passEncriptada = encriptar(username,password)

   User.findOne({userId:username},function (err, user){
      if(user){
    //comprabamos si la contraseña encriptada es igual a la contraseña encriptada anteriormente
         if(user.password == passEncriptada &&
            user.status == 'Activo')
            res.send('OK')
         else
            res.send('contraseña incorrecta')
      }
      else
         res.send('usuario no existe')
   })
})
//obtener datos usuario
Router.post('/user', function(req, res) {
   var username = req.body.usuario;
   User.findOne({userId:username},function (err, user){
      if(user){
        //enviamos data usuario
          console.log('usuario encontrado');
        res.json(user)
      }
      else
         console.log('usuario no existe')
   })
})
//Obtener todos los usuarios
Router.post('/all', function(req, res) {
    var username = req.body.usuario;
    User.findOne({userId:username},function (err, user){
       if(user){
         EventCalendar.find({user: user.id}).exec(function(err, docs) {
             if (err) {
                 res.status(500)
                 res.json(err)
             }
             res.json(docs)
           });
       }
     });
})

// Obtener un usuario por su id
Router.get('/', function(req, res) {
  User.findOne({userId:"usuario@gmail.com"},function (err, user){
     if(user){
       EventCalendar.find({user: user.id}).exec(function(err, docs) {
           if (err) {
               res.status(500)
               res.json(err)
           }
           res.json(docs)
         });
     }
   });
})

// Agregar a un evento
Router.post('/new', function(req, res) {
      var userid = req.body.userId;
      var fechaInicio = new Date(req.body.start);
      var fechaFin = new Date(req.body.end);
      User.findOne({userId:userid},function (err, user){
         if(user){
           var evento = new EventCalendar({
             _id: new mongoose.Types.ObjectId(),
             title: req.body.title,
             user: user.id,
             startDate: fechaInicio,
             endDate: fechaFin,
             startHour: fechaInicio.getHours(),
             endHour: fechaFin.getHours()
           });
           evento.save(function(error) {
               if (error) {
                   res.status(500)
                   res.json(error)
               }
               res.send("Registro guardado");
           });
         }
       });
    })

//update
Router.post('/update', function(req, res) {
  EventCalendar.findByIdAndUpdate(req.body.id,
  {
    startDate: req.body.start,
    endDate: req.body.end,
    startHour: req.body.startHour,
    endHour: req.body.endHour
  },
  function(error, evento) {
    if (error) {
        res.status(500)
        res.json(error)
    }
    res.send("Actualizado");
  });
})

// Eliminar un usuario por su id
Router.post('/delete', function(req, res) {
  EventCalendar.findByIdAndRemove(req.body.id,
  function(error, evento) {
    if (error) {
        res.status(500)
        res.json(error)
    }
    res.send("Actualizado");
  });
})

// Inactivar un usuario por su id
Router.post('/inactive/:id', function(req, res) {

})

// Activar un usuario por su id
Router.post('/active/:id', function(req, res) {

})

module.exports = Router
