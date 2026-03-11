# Postman Collection – Riyadh Amaken API

## Import into Postman

1. Open Postman.
2. Click **Import** (top left).
3. Choose **Upload Files** and select:
   - `Riyadh-Amaken-API.postman_collection.json`
4. Click **Import**.

## Collection variables

- **base_url**: `http://127.0.0.1:8000/api`  
  Change this if your API runs on another host/port (e.g. production URL).

- **auth_token**: *(optional)*  
  After **Login** or **Register**, copy `data.token` from the response and set this variable. It is used in the **Authorization: Bearer {{auth_token}}** header for Logout and Get current user.

- **slider_id**, **category_id**, **gallery_id**, **activity_id**, **event_id**, **user_id**: `1`  
  Set these to existing IDs when testing Get / Update / Delete.

## Folders and requests

| Folder     | Requests |
|-----------|----------|
| Auth      | Register, Login, Logout, Get current user |
| Sliders   | List, Get, Create, Update, Delete |
| Users     | List, Get, Create, Update, Delete |
| Categories| List, Get, Create, Update, Delete |
| Gallery   | List, Get, Create, Update, Delete |
| Activities| List, Get, Create, Update, Delete |
| Events    | List, Get, Create, Update, Delete |
| Settings  | List, Update |

Create/Update requests that accept JSON have example bodies. Sliders, Categories, and Gallery Create use **form-data** when an image is required (add a file in the `image` field).

## Authentication

All API endpoints **except Register and Login** require authentication. The collection is configured to send `Authorization: Bearer {{auth_token}}` on every request.

1. Call **Auth → Login** (or **Register**) and copy `data.token` from the response.
2. Set the collection variable **auth_token** to that value (Edit collection → Variables, or use a test script to set it automatically).
3. All other requests (Sliders, Categories, Gallery, etc.) will then work. Without a valid token they return `401 Unauthorized`.

## Base URL

Ensure the Laravel app is running (`php artisan serve`) so `http://127.0.0.1:8000` is correct, or edit the collection variable **base_url** to match your environment.
