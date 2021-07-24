import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import CardContent from '@material-ui/core/CardContent';
import CardMedia from '@material-ui/core/CardMedia';
import Typography from '@material-ui/core/Typography';

const useStyles = makeStyles({
  root: {
    borderRadius:'20px',
    width:'100%',
    height:150,
    marginTop:20
  },
  media: {
    alignContent:"center",
    height: 50,
    width:50,
    display: "inline-block"
  },
  content:{
    fontSize:15,
    color:'rgb(4 125 138)'
  }
});

export default function MediaCard(props) {
  const classes = useStyles();

  return (
    <>
    <Card className={classes.root}>
    <CardContent className={classes.content}>
        {props.content}
        </CardContent>
      <CardActionArea>
      </CardActionArea>
      <CardActionArea>
        <CardMedia>{props.servicesText1}</CardMedia>
      </CardActionArea>
    </Card>
    <Typography>      
    </Typography>
    </>
  );
}
