const express = require('express');
const cors = require('cors');
const ChatRoute = require('./Routes/ChatRoute.js');
const MessageRoute = require('./Routes/MessageRoute.js')
const UserRoute = require('./Routes/UserRoute.js')
const ClientRoute = require('./Routes/ClientRoute.js')
const InfluencerRoute = require('./Routes/InfluencerRoute.js')
const PromotionRoute = require('./Routes/PromotionsRoute.js')
const connectDB = require('./Config/db.js');
const dotenv = require('dotenv');
const { notFound, errorHandler } = require('./Middleware/errorMiddleware.js');


dotenv.config();

const app = express();
 
app.use(express.json({ extended: true}));
app.use(express.urlencoded({extended: true}));

const corsOptions = {
  origin: ['http://localhost:3000', 'https://fullstack-marketing-hub.vercel.app'],
  credentials: true,
};


app.use(cors(corsOptions))

app.use('/api/users', UserRoute)
app.use('/api/chat', ChatRoute); 
app.use('/api/message',MessageRoute);
app.use('/api/clients',ClientRoute);
app.use('/api/influencers',InfluencerRoute);
app.use('/api/promotions',PromotionRoute)

app.use(notFound)
app.use(errorHandler)

connectDB().then(() => {
    const port = process.env.PORT || 5000;
    app.listen(port, () => {
      console.log(`Server is on port ${port}`); 
    });
  });
   