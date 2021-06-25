import React, { Component } from 'react';
import "react-responsive-carousel/lib/styles/carousel.min.css"; // requires a loader
import sliderImage from '../assets/images/laptop-slider_page.jpg';
import pic1 from '../assets/images/Picture1.png'
import pic2 from '../assets/images/Picture2.png'
import pic3 from '../assets/images/Picture3.png'
import pic4 from '../assets/images/Picture4.png'
import pic5 from '../assets/images/Picture5.png'
import pic6 from '../assets/images/Picture6.png'
import pic7 from '../assets/images/Picture7.png'
import pic8 from '../assets/images/Picture8.png'
import Carousel from 'react-bootstrap/Carousel';
import { Button, Container, Row, Col, Image } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import MediaCard from './MediaCard'
import SwipeableTextMobileStepper from './SwipeableTextMobileStepper';
const buttonStyle = { backgroundColor: 'rgb(230 67 89)', borderRadius: '15px', width: '100%', height: '40px', border: '1px solid yellow' }
class Home extends Component {
  handleBook = () => {

    this.props.history.push("/book")

  }
  render() {
    return <>
      <Container style={{backgroundColor:'white'}}>
      <Row>
        <Col>
      <Carousel>
        <Carousel.Item>
          <Image
            src={sliderImage}
            alt="Best Laptop Repair Service In Mumbai"
            />
          {/* <Carousel.Caption>
              
            </Carousel.Caption> */}
        </Carousel.Item>
      </Carousel>
      </Col>
      </Row>
      <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
          <Col s={12} lg={12}>
            <h1 style={{ color: 'rgb(3 127 121)', fontSize: '30px' }}>Best Laptop Repair Service In Mumbai</h1>
          </Col>
        </Row>
        <Row className="justify-content-md-center">
          <Col s={12} lg={2} style={{ marginBottom: '10px' }}>
            <Button style={buttonStyle} onClick={this.handleBook}>Book</Button>
          </Col>
          <Col s={12} lg={2} style={{ marginBottom: '10px' }}>
            <Button href="tel:9004514467" target="_blank" style={buttonStyle}>Call</Button>
          </Col>
          <Col s={12} lg={2} style={{ marginBottom: '10px' }}>
            <Button target="_blank" href="https://api.whatsapp.com/send?phone=919004514467&amp;text=I'm%20interested%20in%20your%20services" style={buttonStyle}>Chat</Button>{' '}
          </Col>
        </Row>
      </Container>
      <hr />
      <Container>
        <Row>
          <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h3>How It Works!</h3></Col>
        </Row>
        <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
          <Col s={12} lg={3}>
            <MediaCard image={pic1} content='Tell Requirement' />
          </Col>
          <Col s={12} lg={3}>
            <MediaCard image={pic2} content='Enter Details' />
          </Col>
          <Col s={12} lg={3}>
            <MediaCard image={pic3} content='Doorstep Service' />
          </Col>
          <Col s={12} lg={3}>
            <MediaCard image={pic4} content='Pay After Service' />
          </Col>
        </Row>
      </Container>
      <hr />
      <Container>
        <Row>
          <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h3>Why We Are Best!</h3></Col>
        </Row>
        <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
          <Col s={12} lg={3}>
            <MediaCard image={pic5} content='Safe & Hygienic' />
          </Col>
          <Col s={12} lg={3}>
            <MediaCard image={pic6} content='Warranty & Replacement' />
          </Col>
          <Col s={12} lg={3}>
            <MediaCard image={pic7} content='Free Pick & Drop' />
          </Col>
          <Col s={12} lg={3}>
            <MediaCard image={pic8} content='Trusted Professionals' />
          </Col>
        </Row>
      </Container>
      <hr />
      <Container> 
      <Row>
          <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h3>Our Laptop Repair Services</h3></Col>
        </Row>
         
      <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
          <Col>
          <SwipeableTextMobileStepper/>
          </Col>
      </Row>
      
      </Container>

    </>
  }
}
export default Home;