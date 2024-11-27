# chatbot
#composer require cyrox/chatbot:dev-main#

Cyrox Chatbot This is a lightweight chatbot package that can be easily embedded into any website via Composer. It integrates with OpenAI to provide chatbot functionality. Installation and Setup

install as fallow
#composer require cyrox/chatbot:dev-main#
and then publis the vandor 
 php artisan vendor:publish

 then add the tmplate any whare u want 
    @include('vendor.cyrox.chatbot.chatbot')

    run migration 
    
    php artisan make:migration create_chat_histories_table --path=packages/Cyrox/Chatbot/Database/migrations
    
 and dont forget to add ur open ai key in env varables 
 ie OPENAI_API_KEY=sk-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
![image](https://github.com/user-attachments/assets/9b790677-71d7-41b7-8c85-9c37942c92ea)


   
set up in laravel inertia react

create a compenent Chatbot.jsx


import React, { useState } from "react";

const ChatbotPage = () => {
    const [isVisible, setIsVisible] = useState(true);

    return (
        isVisible && (
            <div className="fixed bottom-5 right-5 w-full h-full z-[1000000] shadow-lg bg-none rounded-lg">
                <button
                    onClick={() => setIsVisible(false)}
                    className="absolute top-2 right-2 text-gray-600 hover:text-gray-800"
                >
                    
                </button>
                <iframe
                    src="/chatbot-blade"
                    className="w-full h-full border-none rounded-lg"
                    title="Chatbot"
                ></iframe>
            </div>
        )
    );
};

export default ChatbotPage;




then make a ChatbotControlller 

<?php

namespace App\Http\Controllers;

use App\Models\chatbot;
use App\Http\Requests\StorechatbotRequest;
use App\Http\Requests\UpdatechatbotRequest;

class ChatbotController extends Controller
{
   public function show()
    {
        return view('app')->with('content', view('vendor.cyrox.chatbot.chatbot'));
    }
    }

    finally addd these route
    Route::get('/chatbot-blade', function () {
    return view('vendor.cyrox.chatbot.chatbot');
});
