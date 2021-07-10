const express = require('express'); //Line 1
const app = express(); //Line 2
const port = process.env.PORT || 5000; //Line 3
const bodyParser = require("body-parser");
const router = express.Router();
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

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.listen(port, () => console.log(`Listening on port ${port}`)); //Line 6

// add router in express app
app.use("/",router);

router.post('/getOrder', (req, res) => { //Line 9
  
  console.log(" req "+ JSON.stringify(req.body))
  connection.query("INSERT into order_master SET service_type='Laptop Repair',service_desc='Laptop Repair',time_slot='10-07-2021',cust_name='Akash_10_07_2021_1',cust_phone_no='8378809034',cust_address='Navi Mumbai',cust_city='Mumbai',email='akkiproid@gmail.com',cust_area='Dombivili',reject_reason='No',order_date='09-07-2021', service_date='09-07-2021', userid='9975212', coupon_code='abcd',assigned_to='unassigned', status='unassigned'", function (err, results) {
    if (err) throw err
    console.log("Inserted the Data"+JSON.stringify(results))
  })
  res.send({ express: 'Insterted' }); //Line 10
});

app.use('/', express.static('./build'));
