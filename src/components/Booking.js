import React from 'react';
import { Form,Container,Button,Row,Col } from 'react-bootstrap';
import booking from '../assets/images/booking.jpg'
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios'
const  Booking =()=>{
  const [ form, setForm ] = React.useState({})
  const [ errors, setErrors ] = React.useState({})
  const setField = (field, value) => {
    setForm({
      ...form,
      [field]: value
    })
  }

const handleSubmit=(e)=>{
  // console.log("Form Values  :"+JSON.stringify(form))
  alert("Form Values  :"+JSON.stringify(form))
  axios.get('https://tinggtongg.com/sample_rest.php/get_order?id=6085').
  then(resp=> console.log('Success')).
  catch(error=> console.log('error'))
  e.preventDefault()
  
}
    return (
      <Container >
        <Row>
        <Col xs={12} lg={6}>
        <div className="hideMobile">  
        <img
            className="d-block w-100"
            src={booking}
            alt="Laptop Repair Booking"/>
        </div>    
        </Col>
        <Col xs={12} lg={6} style={{borderRadius:'30px',backgroundColor:'#abecdc'}}>
        <Form id="myForm" >
        <Form.Group controlId="ControlInput1" onChange={ e => setField('ControlInput1', e.target.value) }>
        <Form.Label>Name</Form.Label>
            <Form.Control type="text" placeholder="" />
          </Form.Group>
          <Form.Group controlId="ControlInput2" onChange={ e => setField('ControlInput2', e.target.value) }>
          <Form.Label>Mobile No</Form.Label>
            <Form.Control type="text" placeholder="" />
          </Form.Group>
          <Form.Group controlId="ControlInput3" onChange={ e => setField('ControlInput3', e.target.value) }>
          <Form.Label>Email</Form.Label>
            <Form.Control type="email" placeholder="" />
          </Form.Group>
          <Form.Group controlId="ControlTextarea4" onChange={ e => setField('ControlTextarea4', e.target.value) }>
            <Form.Label>Issues</Form.Label>
            <Form.Control as="textarea" rows={2} />
          </Form.Group>
          <Form.Group controlId="ControlTextarea5" onChange={ e => setField('ControlTextarea5', e.target.value) }>
            <Form.Label>Address</Form.Label>
            <Form.Control as="textarea" rows={2} />
          </Form.Group>
          <Form.Group style={{display:'grid'}}>
          <Button  color='primary' variant='success' type='submit' onClick={handleSubmit}>
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