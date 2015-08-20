FORMAT: 1A
HOST: http://riddlebox.stagingapps.net/

# RiddleBox

RiddleBox API to give user a riddle to guess.

# RiddleBox API Root [/]

This resource does not have any attributes. Instead it offers the initial
API affordances in the form of the links in the JSON body.

## Retrieve the Entry Point [GET]

+ Response 200 (application/json)

        {
            "signin_url": "/signin",
            "answer_url": "/answer"
        }

## Group Users

Resources related to questions in the API.

## Sign In [/signin]

Sign in and get the riddle.

**POST Parameters:**

+ **name** - (required, string) - Name of user. ex: *Pangeran Diponegoro*
+ **email** - (required, string) - E-mail address of the user. ex: *diponegoro@riddle.box*

**RESPONSE data attributes:**

+ **name** - Registered Name.
+ **email** - Registered e-mail address.
+ **riddle** - Object of Riddle.

### Sign in Response [POST]

+ Request (multipart/form-data; boundary=---BOUNDARY)

        -----BOUNDARY
        Content-Disposition: form-data; name="name"
        Pangeran Diponegoro
        -----BOUNDARY
        Content-Disposition: form-data; name="email"
        diponegoro@riddle.box
        -----BOUNDARY

+ Response 200 (application/json)

        {
            "error": 0,
            "code" : 200,
            "message": "Successfully registered",
            "data": {
                "name": "Diponegoro",
                "email": "diponegoro@riddle.box",
                "riddle": {
                    "id": 2,
                    "type": "text",
                    "content": "This lake is the largest volcanic lake in the world and is in Sumatra, Indonesia. Samosir island within the lake is an island within the island of Sumatra.",
                    "question": "What is the name of largest lake in Indonesia?",
                    "clues": [
                        "L1",
                        "A2",
                        "K3",
                        "E4",
                        "",
                        "T5",
                        "O6",
                        "B7",
                        "A8"
                    ]
                }
            }
        }

## Group Riddles

Resources related to riddle in the API.

## Answer Riddle [/answer]
Guess a riddle.

**POST Parameters:**

+ **email** - (required, string) - Registered e-mail address. ex: *diponegoro@riddle.box*
+ **riddle_id** - (required, integer) - Riddle ID. ex: *2*
+ **answer** - (required, string) - Answer to riddle. ex: *KUTA BALI*

**RESPONSE data attributes:**

+ **name** - Name of user.
+ **email** - E-mail address of the user.

### Answer Riddle Response [POST]
+ Request (multipart/form-data; boundary=---BOUNDARY)

        -----BOUNDARY
        Content-Disposition: form-data; name="email"
        diponegoro@riddle.box
        -----BOUNDARY
        Content-Disposition: form-data; name="riddle_id"
        2
        -----BOUNDARY
        Content-Disposition: form-data; name="answer"
        DANAU TOBA
        -----BOUNDARY

+ Response 200 (application/json)

        {
            "error": 0,
            "code" : 200,
            "message": "Correct Answer!",
            "data": {
                "riddle_id": 2,
                "status": "solved",
                "solved_date": "2015-08-20 14:21:22"
            }
        }

+ Response 200 (application/json)

        {
            "error": 0,
            "code" : 210,
            "message": "Wrong Answer!",
            "data": {
                "riddle_id": 2,
                "status": "unsolved",
                "solved_date": null
            }
        }

