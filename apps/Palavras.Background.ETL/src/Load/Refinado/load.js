const axios = require('axios')
require('dotenv').config()
module.exports = {
    load: async (collection) => {
        await axios.post('http://pmc-api/PageWord/StoreWord', {
            Token: process.env.Token,
            Palavras: collection
        })
    }
}