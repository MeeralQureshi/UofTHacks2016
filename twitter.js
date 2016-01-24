//NODEJS
//npm install twitter-node-client
//var Twitter = require('twitter-node-client').Twitter;


 //Callback functions
    var error = function (err, response, body) {
        console.log('ERROR [%s]', err);
    };
    var success = function (data) {
        console.log('Data [%s]', data);
    };

    var Twitter = require('twitter-js-client').Twitter;

    //Get this data from your twitter apps dashboard
    var config = {
        "consumerKey": "XgA2skxeI3KqNkZAKvwIsM6k6",
        "consumerSecret": "N3g1GntYFpvrX2g3pZQPMeH74gL4DZgfVMe3a6QYPzx34ul0Zv",
        "accessToken": "4837643469-0l7fqURQzp9QBH01qcXJk6WOWHNYacV4I5j4uCH",
        "accessTokenSecret": "6WJxt4Yn7UmLjigfYazoiJLbXHcsFNfaOwvYJ7QCQrD3u",
        "callBackUrl": "http://www.google.com"
    }

    var twitter = new Twitter(config);

    var tweet = twitter.getTweet({ id: '690978123861626880'}, error, success);

    //text -> tweet.text