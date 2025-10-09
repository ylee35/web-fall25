from fastapi import FastAPI, Request
from fastapi.middleware.cors import CORSMiddleware
from datetime import datetime

app = FastAPI()

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
    if latest_water_data["timestamp"] is None:
        return {"message": "No data received yet."}
    return latest_water_data


# runs a POST request to /water
# reads JSON sent in the body of the request, prints it, and replies with a confirmation
@app.post("/water")
async def receive_data(request: Request):
    data = await request.json()  # read JSON body
    print("📥 Received data:", data)

     # update the global latest_water_data variable
    latest_water_data["timestamp"] = datetime.utcnow().isoformat() + "Z"
    latest_water_data["water_level"] = data.get("water_level")

    return {"status": "ok", "message": "Data received successfully"}
