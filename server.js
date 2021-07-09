const express = require('express'); //Line 1
const app = express(); //Line 2
const port = process.env.PORT || 5000; //Line 3

var mysql = require('mysql')

var connection = mysql.createConnection({
  host: '182.50.133.80',
  user: 'tinggton_subhoji',
  password: 'Cationstech@07',
  database: 'tinggton_maindb'
})

connection.connect(function(err) {
  if (err) throw err
  console.log('You are now connected...')
})

app.listen(port, () => console.log(`Listening on port ${port}`)); //Line 6

app.post('/getOrder', (req, res) => { //Line 9
  
  console.log(" req.body "+ JSON.stringify(req.body))
          connection.query('SELECT * FROM order_master', function(err, results) {
            if (err) throw err
            console.log(JSON.stringify(results[0]))
          })
  res.send({ express: 'Insterted' }); //Line 10
});

app.use('/', express.static('./build'));