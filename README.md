# chatbot
#composer require cyrox/chatbot:dev-main#

Cyrox Chatbot This is a lightweight chatbot package that can be easily embedded into any website via Composer. It integrates with OpenAI to provide chatbot functionality. Installation and Setup

install as fallow
#composer require cyrox/chatbot:dev-main#
and then publis the vandor 
 php artisan vendor:publish

 then add the tmplate any whare u want 
    @include('vendor.cyrox.chatbot.chatbot')
    
 and dont forget to add ur open ai key in env varables 
 ie OPENAI_API_KEY=sk-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


   
