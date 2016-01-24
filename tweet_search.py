#REQ: python 2.x (2.7?)
#pip install tweepy
import tweepy
import json
 
class StdOutListener(tweepy.StreamListener):
    ''' Handles data received from the stream. '''
 
    def on_status(self, status):
        # Prints the text of the tweet
        print('Tweet text: ' + status.text)
 
        # There are many options in the status object,
        # hashtags can be very easily accessed.
        for hashtag in status.entries['hashtags']:
            print(hashtag['text'])
 
        return true
 
    def on_error(self, status_code):
        print('Got an error with status code: ' + str(status_code))
        return True # To continue listening
 
    def on_timeout(self):
        print('Timeout...')
        return True # To continue listening
 

def tweet_parse(text):
    "name: Owen Sawyer Age: 20 Gender: M Description: best picture: nah #missing #coolestkid #missingmaptest"
    '''Name: 
    Age: (in years)
    Gender: (M/F)
    Description: (Brief) 
    Picture: (Optional)
    
    return: [name,age,gender,description,picture]
    '''
    text = text.lower()
    name = text.split('age')[0]
    age = text.split('gender')[0]
    gender = text.split('description')[0]
    desc = text.split('picture')[0]
    pic = text.split('#missing')[0]
    hashtag = text.find('#missing')

    returnlist = [name.split('name:')[1],
                  age.replace(name,"").split('age:')[1],
                  gender.replace(age,"").split('gender:')[1],
                  desc.replace(age,"").split('description:')[1],
                  pic.replace(desc,"")[:hashtag].split('picture:')[1]]
    for i in range(len(returnlist)):
        returnlist[i] = returnlist[i].strip()
    return returnlist
 
 
if __name__ == '__main__':
    
    consumer_key = 'XgA2skxeI3KqNkZAKvwIsM6k6'
    consumer_secret = 'N3g1GntYFpvrX2g3pZQPMeH74gL4DZgfVMe3a6QYPzx34ul0Zv'
    access_token = '4837643469-0l7fqURQzp9QBH01qcXJk6WOWHNYacV4I5j4uCH'
    access_token_secret = '6WJxt4Yn7UmLjigfYazoiJLbXHcsFNfaOwvYJ7QCQrD3u'    
    
    listener = StdOutListener()
    auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
    auth.set_access_token(access_token, access_token_secret)
    api = tweepy.API(auth)
    stream = tweepy.Stream(auth, listener)
    
    
    #Query Operators: https://dev.twitter.com/rest/public/search
    #query = '#dog OR #cat -RT' 
    query = '#missing -RT'
    max_tweets = 300
    restrict = tweepy.Cursor(api.search,  
              query,
              since="2010-01-01",
              until="2016-01-24", 
              ).items(max_tweets)
    
    for status in restrict:  
        if status.geo is not None:
        #if 'RT ' not in status.text.encode('utf8'):
            returndict = [status.id, status.geo['coordinates'][0], status.geo['coordinates'][0]]
            print (returndict)
            #print(status.entities['urls']['expanded_url'])
            print ('---')
        else:
            pass



#STATUS object structure:
#{
 #'contributors': None, 
 #'truncated': False, 
 #'text': 'My Top Followers in 2010: @tkang1 @serin23 @uhrunland @aliassculptor @kor0307 @yunki62. Find yours @ http://mytopfollowersin2010.com',
 #'in_reply_to_status_id': None,
 #'id': 21041793667694593,
 #'_api': <tweepy.api.api object="" at="" 0x6bebc50="">,
 #'author': <tweepy.models.user object="" at="" 0x6c16610="">,
 #'retweeted': False,
 #'coordinates': None,
 #'source': 'My Top Followers in 2010',
 #'in_reply_to_screen_name': None,
 #'id_str': '21041793667694593',
 #'retweet_count': 0,
 #'in_reply_to_user_id': None,
 #'favorited': False,
 #'retweeted_status': <tweepy.models.status object="" at="" 0xb2b5190="">,
 #'source_url': 'http://mytopfollowersin2010.com', 
 #'user': <tweepy.models.user object="" at="" 0x6c16610="">,
 #'geo': None, 
 #'in_reply_to_user_id_str': None, 
 #'created_at': datetime.datetime(2011, 1, 1, 3, 15, 29), 
 #'in_reply_to_status_id_str': None, 
 #'place': None
#}


