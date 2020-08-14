import React from 'react';
import { makeStyles, createStyles } from '@material-ui/core';
import Box from '@material-ui/core/Box';
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TextField from '@material-ui/core/TextField';
import '../css/App.css';

const useStyles = makeStyles(() => 
    createStyles({
        shortenInput: {
            width: '75%',
            height: '56px',
        },
        shortenButton: {
            width: '25%',
            height: '56px',
        }
    })
)

export default function App() {
    const classes = useStyles();

    return (
        <React.Fragment>
            <CssBaseline />
            <div className="flex-center position-ref full-height">
                <div className="content">
                    <h1 className="title">Shorter URL</h1>
                    <Box className="m-b-md">
                        <TextField className={classes.shortenInput} variant="outlined" placeholder="Shorten your link"></TextField>
                        <Button className={classes.shortenButton} variant="contained" color="primary">Shorten</Button>
                    </Box>
                </div>
        </div>
        </React.Fragment>
    );
}