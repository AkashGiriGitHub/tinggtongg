import React from 'react';
import { makeStyles, useTheme } from '@material-ui/core/styles';
import MobileStepper from '@material-ui/core/MobileStepper';
import Paper from '@material-ui/core/Paper';
import Typography from '@material-ui/core/Typography';
import Button from '@material-ui/core/Button';
import KeyboardArrowLeft from '@material-ui/icons/KeyboardArrowLeft';
import KeyboardArrowRight from '@material-ui/icons/KeyboardArrowRight';
import SwipeableViews from 'react-swipeable-views';
import { autoPlay } from 'react-swipeable-views-utils';
import { Container, Row, Col, Image } from 'react-bootstrap';
import fixing from '../assets/images/fixing.png'
import pic from '../assets/images/person7.jpg'
import ReviewCard from './ReviewCard'

const AutoPlaySwipeableViews = autoPlay(SwipeableViews);

const tutorialSteps = [

    {
        subHead: 'Formatting and Anti Virus',
        label: 'Formatting of your machine with antivirus and data restoration.'
    },
    {
        subHead: 'Hard drive',
        label: 'Avail this service for all issues such as blue screens,floating pixels etc.'
    }
];

const useStyles = makeStyles((theme) => ({
    root: {
        maxWidth: '100%',
        flexGrow: 1,
        backgroundColor:'white'
        // height:200
    },
    header: {
        display: 'flex',
        alignItems: 'center',
        // height: 50,
        width: '100%',
        // paddingLeft: theme.spacing(0),
        backgroundColor: theme.palette.background.default,
        // height:200
    },
    img: {
        height: '150px',
        display: 'inline-block',
        width: '150px',
        overflow: 'hidden',
    },
}));

function Review() {
    const classes = useStyles();
    const theme = useTheme();
    const [activeStep, setActiveStep] = React.useState(0);
    const maxSteps = tutorialSteps.length;

    const handleNext = () => {
        setActiveStep((prevActiveStep) => prevActiveStep + 1);
    };

    const handleBack = () => {
        setActiveStep((prevActiveStep) => prevActiveStep - 1);
    };

    const handleStepChange = (step) => {
        setActiveStep(step);
    };

    return (
        <div className={classes.root}>
            <AutoPlaySwipeableViews
                axis={theme.direction === 'rtl' ? 'x-reverse' : 'x'}
                index={activeStep}
                onChangeIndex={handleStepChange}
                enableMouseEvents
            >
                {tutorialSteps.map((step, index) => (
                    <div key={step.label}>
                        {Math.abs(activeStep - index) <= 2 ? (
                            <>
                                <Container style={{ padding: '20px' }}>
                                    <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
                                    <Col s={12} lg={6}>
                                        <ReviewCard image={pic} content='Very Professional and Helpful service received by Mr Vinod. Glad I chose the services. Thanks.' custName='Madhav krishnatri'/>
                                    </Col>
                                    <Col s={12} lg={6}>
                                        <ReviewCard image={pic} content='Mr. Vinod Singh was efficient and fixed the problem quickly. He was also following all covid protocols - had his sanitiser, was masked throughout the visit.' custName='Amrtha Kasturi Rangan'/>
                                    </Col>
                                    {/* <Col s={12} lg={3}>
                                        <ReviewCard image={pic} content='Good service by Vinod Singh' custName='Girish Pawar'/>
                                    </Col>
                                    <Col s={12} lg={3}>
                                        <ReviewCard image={pic} content='Vinod did excellent work with limited time good work.' custName='Parth Marfatia'/>
                                    </Col> */}
                                    </Row>
                                    <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
                                    {/* <Col s={12} lg={3}>
                                    <ReviewCard image={pic} content='Vinod Singh professional worker good communication with client. 💯% satisfied work.. thank you.. Highly recommended..' custName='KRUTIKA SHINDE'/>
                                    </Col>
                                    <Col s={12} lg={3}>
                                    <ReviewCard image={pic} content='Really appreciate. Very nice service provided by Mr Vinod Singh . Very good behavior.rates are also very reasonable.' custName='Sachin Naveen'/>
                                    </Col> */}
                                    <Col s={12} lg={6}>
                                    <ReviewCard image={pic} content='Very fast Service' custName='Khortha Ka Deewana'/>
                                    </Col>
                                    <Col s={12} lg={6}>
                                    <ReviewCard image={pic} content='Responsive and responsible people... My laptop work was done by Mr vinod Singh, Very much professional or more than that..👍' custName='Deepak Sharma'/>
                                    </Col>
                                    </Row>
                                </Container>
                            </>
                        ) : null}
                    </div>
                ))}
            </AutoPlaySwipeableViews>
            <MobileStepper
                steps={maxSteps}
                position="static"
                variant="text"
                activeStep={activeStep}
                nextButton={
                    <Button size="small" onClick={handleNext} disabled={activeStep === maxSteps - 1}>
                        Next
            {theme.direction === 'rtl' ? <KeyboardArrowLeft /> : <KeyboardArrowRight />}
                    </Button>
                }
                backButton={
                    <Button size="small" onClick={handleBack} disabled={activeStep === 0}>
                        {theme.direction === 'rtl' ? <KeyboardArrowRight /> : <KeyboardArrowLeft />}
            Back
          </Button>
                }
            />
        </div>
    );
}

export default Review;
