import React from 'react';
import { Form,Container,Button,Row,Col } from 'react-bootstrap';
import booking from '../assets/images/booking.jpg'
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios'

const  Booking =(props)=>{
  const [ form, setForm ] = React.useState({})
  const [ error, setError ] = React.useState(null)
  const [saved,setSaved] = React.useState(false)
  const setField = (field, value) => {
    setForm({
      ...form,
      [field]: value
    })
  }

const handleSubmit= (e)=>{
  const response = axios.post('/order',form)
  .then(resp=>{
    props.history.push({
      pathname: '/confirm',
      search: '',
      state: { detail: form }
    })
    
  })
  .catch(error=>setError("Error in Booking"))
  }
   
return (
      <Container style={{marginTop:'5%'}}>
        <Row>
        <Col xs={12} lg={6}>
        <div className="hideMobile">  
        <img
            className="d-block w-100"
            src={booking}
            alt="Laptop Repair Booking"/>
        </div>    
        </Col>
        <Col xs={12} lg={5}>
        <div>{error}</div>
        <Form id="myForm" >
        <Form.Group controlId="name" onChange={ e => setField('name', e.target.value) }>
        <Form.Label>Name</Form.Label>
            <Form.Control type="text" placeholder="" />
          </Form.Group>
          <Form.Group controlId="phoneNo" onChange={ e => setField('phoneNo', e.target.value) }>
          <Form.Label>Mobile No</Form.Label>
            <Form.Control type="text" placeholder="" />
          </Form.Group>
          <Form.Group controlId="email" onChange={ e => setField('email', e.target.value) }>
          <Form.Label>Email</Form.Label>
            <Form.Control type="email" placeholder="" />
          </Form.Group>
          <Form.Group controlId="issues" onChange={ e => setField('issues', e.target.value) }>
            <Form.Label>Issues</Form.Label>
            <Form.Control as="textarea" rows={2} />
          </Form.Group>
          <Form.Group controlId="address" onChange={ e => setField('address', e.target.value) }>
            <Form.Label>Address</Form.Label>
            <Form.Control as="textarea" rows={2} />
          </Form.Group>
          <Form.Group style={{display:'grid'}}>
          <Button  color='primary' variant='success' onClick={handleSubmit}>
                      Submit
          </Button>
          </Form.Group>
        </Form>
        </Col>
        </Row>
      </Container>
    );
  }


export default Booking;