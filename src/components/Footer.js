import pic1 from '../assets/images/Picture1.png'
import pic2 from '../assets/images/Picture2.png'
import pic3 from '../assets/images/Picture3.png'
import pic4 from '../assets/images/Picture4.png'
import 'bootstrap/dist/css/bootstrap.min.css';
import FooterCard from './MediaCard'
import { Button, Container, Row, Col, Image, Jumbotron } from 'react-bootstrap';

export default function Footer(){
    return <Container style={{backgroundColor:'grey',paddingBottom:'100px'}}>
    {/* <Row>
      <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}>
        <h1>How It Works!</h1>
        </Col>
    </Row> */}
    <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
      <Col s={12} lg={4}>
        <FooterCard image={pic1} content='ABOUT TINGGTONGG' 
        servicesText1="We are a dedicated team that believes in providing reliable and best laptop Repair services to each and every doorstep in Mumbai." />
      </Col>
      <Col s={12} lg={4}>
        <FooterCard image={pic2} content='Enter Details' />
      </Col>
      <Col s={12} lg={4}>
        <FooterCard image={pic3} content='Doorstep Service' />
      </Col>
    </Row>
  </Container>
  
}