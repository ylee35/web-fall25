from fastapi import FastAPI, Request
from fastapi.middleware.cors import CORSMiddleware
from datetime import datetime
# from pymongo import MongoClient

app = FastAPI()

# # mongodb setup
# MONGO_URI = "mongodb+srv://avareijmers:<EWBMalawi2526*>@ewb-malawi-sensor-data.9lvxgkv.mongodb.net/?appName=ewb-malawi-sensor-data"
# client = MongoClient(MONGO_URI)
# db = client["ewb-malawi-sensor-data"] # database name
# collection = db["water_levels"]       # collection name

# allow frontend to fetch from localhost
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# store latest water data in memory
latest_water_data = {"timestamp": None, "water_level": None}

# this endpoint runs when you do a GET request to /water
# frontend calls this to get data
@app.get("/water")
def get_water_level():
    ## just postman code
    if latest_water_data["timestamp"] is None:
        return {"message": "No data received yet."}
    return latest_water_data

    ## postman + mongodb
    # latest_entry = collection.find_one(sort=[("timestamp", -1)])  # get most recent by timestamp
    # if not latest_entry:
    #     return {"message": "No data found in MongoDB yet."}
    
    # # convert ObjectId to string for JSON compatibility
    # latest_entry["_id"] = str(latest_entry["_id"])
    # return latest_entry


# runs a POST request to /water
# reads JSON sent in the body of the request, prints it, and replies with a confirmation
@app.post("/water")
async def receive_data(request: Request):

    ## just postman code
    data = await request.json()  # read JSON body
    print("Received data:", data)

     # update the global latest_water_data variable
    latest_water_data["timestamp"] = datetime.utcnow().isoformat() + "Z"
    latest_water_data["water_level"] = data.get("water_level")

    return {"status": "ok", "message": "Data received successfully"}

    ## postman + mongodb
    # data = await request.json()  # read JSON body
    # print("Received data:", data)

    # # prepare document to insert
    # document = {
    #     "timestamp": datetime.isoformat() + "Z",
    #     "water_level": data.get("water_level"),
    # }

    # # insert into MongoDB
    # result = collection.insert_one(document)
    # return {"status": "ok", "inserted_id": str(result.inserted_id)}
godaddy