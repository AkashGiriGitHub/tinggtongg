import React, { Component } from 'react';
import "react-responsive-carousel/lib/styles/carousel.min.css"; // requires a loader
import sliderImage from '../assets/images/laptop-slider_page.jpg';
import Carousel from 'react-bootstrap/Carousel';
import { Button, Container, Row, Col, Image } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import { faqComponent } from './faqComponent';
import { howItWorkComponent } from './howItWorkComponent';
import { ourServices } from './ourServices';
import { weAreBestComponent } from './weAreBestComponent';
import { reviewComponent } from './reviewComponent';
import { areaCoveredComponent } from './areaCoveredComponent';
const buttonStyle = { background: "linear-gradient(to right, red , #6CCF51)", borderRadius: '15px', width: '100%', height: '40px', border: '1px solid yellow' }
class Home extends Component {
  handleBook = () => {
    this.props.history.push("/book")
  }
  render() {
    return <>
      <Container style={{ backgroundColor: 'white',padding:'50px' }}>
        <Row>
          <Col>
            <Carousel>
              <Carousel.Item>
                <Image
                  src={sliderImage}
                  alt="Best Laptop Repair In Mumbai"
                />
              </Carousel.Item>
            </Carousel>
          </Col>
        </Row>
        <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
          <Col s={12} lg={12}>
            <h1 style={{ color: 'rgb(3 127 121)',fontSize:25 }}>Best Laptop Repair In Mumbai</h1>
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
      
      {ourServices}
      
      {howItWorkComponent}
      
      {weAreBestComponent}
      
      {reviewComponent}
      
      {faqComponent}
      
      {areaCoveredComponent}
    </>
  }
}
export default Home;