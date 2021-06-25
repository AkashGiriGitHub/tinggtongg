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

const AutoPlaySwipeableViews = autoPlay(SwipeableViews);

const tutorialSteps = [

    {
        subHead: 'Formatting and Anti Virus',
        label: 'Formatting of your machine with antivirus and data restoration.'
    },


    {
        subHead: 'Hard drive',
        label: 'Avail this service for all issues such as blue screens,floating pixels etc.'
    },


    {
        subHead: 'Data Recovery',
        label: 'We can recover all your valubale data and also got hard disk repairing done.'
    },


    {
        subHead: 'Software Installation(OS)',
        label: 'All type of Software/OS installations and fixes are provided.'
    },


    {
        subHead: 'Speaker/Mic',
        label: 'We repair and replace all kinds of speakers or mic .'
    },


    {
        subHead: 'Display Problems',
        label: 'We will solve all display issues such as a distorted/no display and so on.'
    },


    {
        subHead: 'Screens Repairing',
        label: 'All kind of LCD and LEDS, paper screens are replaced by us.'
    },


    {
        subHead: 'Keyboard Mouse Trackpad',
        label: 'Keyboard or touchpad isn’t working we can get it repaired or replaced.'
    },


    {
        subHead: 'Battery',
        label: 'We repair/replace the battery of your laptop.'
    },


    {
        subHead: 'Annual Maintenance Contracts',
        label: 'We handle all types of laptops/desktops/printers AMCs.'
    },


    {
        subHead: 'Sales and Service',
        label: 'We sell all Laptops Brands, Desktops both in assembled and branded category.'
    },


    {
        subHead: 'Motherboard Issues',
        label: 'We do all sorts of motherboard repair and replacement work.'
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

function SwipeableTextMobileStepper() {
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
                                <Container style={{ marginTop: '20px' }}>
                                    <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
                                        <Col>
                                            <div style={{ display: 'inline-block' }}>
                                                <img className={classes.img} src={fixing} alt={step.subHead} />
                                                <h3>{step.subHead}</h3>
                                                <Paper square elevation={0} className={classes.header}>
                                                    <Typography>{tutorialSteps[activeStep].label}</Typography>
                                                </Paper>
                                            </div>
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

export default SwipeableTextMobileStepper;
