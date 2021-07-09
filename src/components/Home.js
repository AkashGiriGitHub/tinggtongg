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
import { Button, Container, Row, Col, Image,Jumbotron } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import MediaCard from './MediaCard'
import SwipeableTextMobileStepper from './SwipeableTextMobileStepper';
import Review from './Review';
import Typography from '@material-ui/core/Typography';
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
            <h1 style={{ color: 'rgb(3 127 121)'}}>Best Laptop Repair Service In Mumbai</h1>
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
          <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h1>How It Works!</h1></Col>
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
          <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h1>Why We Are Best!</h1></Col>
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
          <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h1>Our Laptop Repair Services</h1></Col>
        </Row>
         
      <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
          <Col>
          <SwipeableTextMobileStepper/>
          </Col>
      </Row>
      </Container>

     

      <Jumbotron fluid style={{backgroundColor:'white'}}>
      <Container>
        <Row>
          <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h1>FAQs About Best Laptop Repair Service In Mumbai</h1></Col>
        </Row>
      </Container>
        <Container>
          <h3>Which are the commonly occurring laptop problems?</h3>
          <Typography>
          The problems that we will be searching for will include any problems with the central processing unit. We will verify that all of the software is running correctly and that you do not have any viruses or malware on your computer. Our laptop and computer repair experts will check to make sure that the keyboard, mouse pad and screen are all connected and running properly. These are just a few of the things that we will look at while diagnosing the problem, plus we will directly examine the issue that you have brought to our attention to see if they can fix it.
          </Typography>
        </Container>
        <br></br>
        <Container>
          <h3>Which is the most affordable and best laptop repair service company near you?</h3>
          <Typography>
          Huge number of people rely on Laptop and Computer everyday. However, just like PCs, they can have their share of problems which may require some repairs at some point in time. This can be issues with the screen, keyboard, mouse pad, or even the operating system. They could have their hard drive go out, which is quite common, due to how close everything is together on the laptop itself. It is not easy to find a PC/Laptop Repair Service company in Mumbai like us that will help you with these repairs and provide a detailed consultation. Although working on a PC with a tower is relatively easy, laptops are extremely compact. It requires proper grounding, tools, and expertise in fixing anything involving a laptop. Here are some of our qualities that makes us the best laptop and desktop computer repair company near having years of experience and providing these repairs for you at a reasonable price.
          </Typography>
        </Container>
        <br></br>
        <Container>
          <h3>What do you expect from best laptop repair service company like tinggtongg?</h3>
          <Typography>
          Based on our experience in troubleshooting, we can diagnose what the problem is. Even if you can tell us what you believe the problem might be, our experienced software and hardware engineers will do a thorough examination to make sure nothing is missed. Additionally, you will find that tinggtongg Laptop Repair Service in mumbai has a solid reputation. You can go online to see what other people are saying about us. Customer reviews and testimonials allow you to make a logical choice. We have done great work for all of our clients and will be able to do the same for you. We offer laptop repair services for all the leading brands like HP, Acer, Dell, Sony, Lenovo, Compaq, Fujitsu, Toshiba and many more.
          </Typography>
        </Container>
        <br></br>
        <Container>
          <h3>How are our customer reviewes</h3>
          <Typography>
          Your search for the best Laptop Repair Service in mumbai will always begin online. If your computer is not working, you can do this very easily with a smartphone. By checking, Google, and any other review site that you can find, you should be able to find us in the top 2-3 results. You will want to call us to see if we have any available openings. Over the phone call, you can get information about how much we charge for the laptop related repair services that we offer. It is important to gather this information first before deciding to hire our company over another. Once you have set up the appointment, you will feel confident that the choice you have made will help you get your laptop repaired fast.
          </Typography>
        </Container>
        <br></br>
        <Container>
          <h3>How quick are we with laptop and computer repairs?</h3>
          <Typography>
          The speed at which the laptop repairs are done can vary significantly. If it is a common problem such as changing out a sound card when your music is no longer playing, that will usually take less than an hour. If it is a substantial problem such as a computer or laptop that is affected by a virus, or if you are looking at the blue screen of death for the last few days, it may be necessary to leave the computer with us overnight so that we can fully determine what is happening.
          </Typography>
        </Container>
        <br></br>
        <Container>
          <h3>Do we provide warranty?</h3>
          <Typography>
          You will be able to get a guarantee on almost every issue that is reported and discovered. Legitimate businesses like tinggtongg Laptop Repair Service mumbai offer a guarantee on our services. These assurances will typically last for few months, and if you compare the prices that we charge for our services, and the duration of the guarantee, will help you make your final choice with our business. The type of guarantee that you get is of interest as it may not be exactly what you were expecting. Some of the best repair shops like ours will provide you with both a guarantee on parts and labor and will do so for several months, up to a year. Always make sure to ask before you have the work done, to know the details of the guarantee presented. It is very vital to get this information early on, and then subsequently, you can make your final choice to have your repairs done by the reputable organization like us.
          </Typography>
        </Container>
        <br></br>
      </Jumbotron>
      <Container>
        <Row>
          <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h1>Happy Clients of our Laptop Repair Service in Mumbai</h1></Col>
        </Row>
      <Review></Review>
      </Container>
    </>
  }
}
export default Home;