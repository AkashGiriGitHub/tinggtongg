const express = require('express')
const bodyParser = require('body-parser')
const mysql = require('mysql')

const app = express()
const port = process.env.PORT || 5000;

// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: false }))

// parse application/json
app.use(bodyParser.json())
app.use('/', express.static('./build'));
// MySQL
const pool  = mysql.createPool({
    connectionLimit : 10,
    host: '182.50.133.80',
    user: 'tinggton_subhoji',
    password: 'Cationstech@07',
    database: 'tinggton_maindb'
})
   
// Get all beers
app.get('/orders', (req, res) => {
    pool.getConnection((err, connection) => {
        if(err) throw err
        console.log('connected as id ' + connection.threadId)
        connection.query('SELECT * from order_master', (err, rows) => {
            connection.release() // return the connection to pool

            if (!err) {
                res.send(rows)
            } else {
                console.log(err)
            }

            // if(err) throw err
            console.log('The data from beer table are: \n', rows)
        })
    })
})

// Get an beer
app.get('/order/:id', (req, res) => {
    pool.getConnection((err, connection) => {
        if(err) throw err
        connection.query('SELECT * FROM order_master WHERE id = ?', [req.params.id], (err, rows) => {
            connection.release() // return the connection to pool
            if (!err) {
                res.send(rows)
            } else {
                console.log(err)
            }
            
            console.log('The data from beer table are: \n', rows)
        })
    })
});

// Delete a beer
app.delete('/order/:id', (req, res) => {

    pool.getConnection((err, connection) => {
        if(err) throw err
        connection.query('DELETE FROM order_master WHERE id = ?', [req.params.id], (err, rows) => {
            connection.release() // return the connection to pool
            if (!err) {
                res.send(`Beer with the record ID ${[req.params.id]} has been removed.`)
            } else {
                console.log(err)
            }
            
            console.log('The data from beer table are: \n', rows)
        })
    })
});

// Add beer
app.post('/order', (req, res) => {

    pool.getConnection((err, connection) => {
        if(err) throw err
        
        const params = req.body
        console.log("Body : "+JSON.stringify(req.body))
        connection.query("INSERT into order_master SET service_type='Laptop Repair',service_desc='Laptop Repair',time_slot='10-07-2021',cust_name='Akash_10_07_2021_1',cust_phone_no='8378809034',cust_address='Navi Mumbai',cust_city='Mumbai',email='akkiproid@gmail.com',cust_area='Dombivili',reject_reason='No',order_date='09-07-2021', service_date='09-07-2021', userid='9975212', coupon_code='abcd',assigned_to='unassigned', status='unassigned'", params, (err, rows) => {
        connection.release() // return the connection to pool
        if (!err) {
            res.send(`Order with the record ID  has been added.`)
        } else {
            console.log(err)
        }
        
        console.log('The data from order table are:11 \n', rows)

        })
    })
});


app.put('', (req, res) => {

    pool.getConnection((err, connection) => {
        if(err) throw err
        console.log(`connected as id ${connection.threadId}`)

        const { id, name, tagline, description, image } = req.body

        connection.query('UPDATE beers SET name = ?, tagline = ?, description = ?, image = ? WHERE id = ?', [name, tagline, description, image, id] , (err, rows) => {
            connection.release() // return the connection to pool

            if(!err) {
                res.send(`Beer with the name: ${name} has been added.`)
            } else {
                console.log(err)
            }

        })

        console.log(req.body)
    })
})


// Listen on enviroment port or 5000
app.listen(port, () => console.log(`Listening on port ${port}`))