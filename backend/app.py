from fastapi import FastAPI, Request
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()

# allow frontend to fetch from localhost
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

@app.get("/water")
def get_water_level():
    # temporary placeholder data
    return {
        "timestamp": "2025-10-06T00:00:00Z",
        "water_level": 121.3
    }

@app.post("/water")
async def receive_data(request: Request):
    data = await request.json()  # read JSON body
    print("📥 Received data:", data)
    return {"status": "ok", "message": "Data received successfully"}