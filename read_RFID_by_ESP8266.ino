#include <SPI.h>
#include <NTPClient.h>
#include <MFRC522.h>
#include "FirebaseESP8266.h"
#include <ESP8266WiFi.h>
#include <WiFiUdp.h>

#define RST_PIN         D3          // Configurable, see typical pin layout above
#define SS_PIN          D4         // Configurable, see typical pin layout above
#define led             16      
#define buzzer          5        // chip buzzer

#define FIREBASE_HOST "url link firebase" //Without http:// or https:// schemes
#define FIREBASE_AUTH "your-key-id-firebase"
#define WIFI_SSID "your-wifi"
#define WIFI_PASSWORD "your-pass"

WiFiUDP ntpUDP;                    // giao thuc UDP ket noi qua wifi
NTPClient timeClient(ntpUDP);       // bien lay thoi gian tu internet
MFRC522 mfrc522(SS_PIN, RST_PIN);  // Create MFRC522 instance
String uidBefore ="";
int stt = 1;
String k;
String timeIn;

FirebaseData firebaseData;

void firebasereconnect()
{
  Serial.println("Trying to reconnect");
  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH);
  Firebase.reconnectWiFi(true);
}

void setup() {
	Serial.begin(115200);		// Initialize serial communications with the PC
  pinMode(led,OUTPUT);        // LED
  pinMode(buzzer, OUTPUT);      // Chip buzzer
  digitalWrite(buzzer, LOW); 
  while (!Serial);    // Do nothing if no serial port is opened (added for Arduinos based on ATMEGA32U4)
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.print("Connecting to Wi-Fi");
  while (WiFi.status() != WL_CONNECTED)
  {
    Serial.print(".");
    delay(500);
  }
  Serial.println();
  Serial.print("Connected with IP: ");
  Serial.println(WiFi.localIP());
  Serial.println();

  firebasereconnect();

  delay(100);

  timeClient.begin(); 
  timeClient.setTimeOffset(+7*60*60); // set khu vuc mui gio cua VN
  
	SPI.begin();			// Init SPI bus
	mfrc522.PCD_Init();		// Init MFRC522
	delay(4);				// Optional delay. Some board do need more time after init to be ready, see Readme
	mfrc522.PCD_DumpVersionToSerial();	// Show details of PCD - MFRC522 Card Reader details
	Serial.println(F("Scan PICC to see UID, SAK, type, and data blocks..."));
}

void loop() {
	// Reset the loop if no new card present on the sensor/reader. This saves the entire process when idle.
	if ( ! mfrc522.PICC_IsNewCardPresent()) {
		return;
	}

	// Select one of the cards
	if ( ! mfrc522.PICC_ReadCardSerial()) {
		return;
	}

  String uid ="";
    for ( byte i =0; i<mfrc522.uid.size; i++){
//        Serial.println(mfrc522.uid.uidByte[i],HEX);
        uid.concat(String(mfrc522.uid.uidByte[i] <0x10 ? "0" : "")); // neu Byte <0x10 thi them so 0 vao truoc Byte doc duoc
        uid.concat(String(mfrc522.uid.uidByte[i],HEX));
        uid += " ";
    }

    uid = uid.substring(0,uid.length() -1);     // get away the space last
  uid.toUpperCase();
  if (uidBefore == uid)
  {
//    Serial.println("You scan looply UID = "+ uid);
  } else {
    k = String(stt);
    timeClient.update();
    timeIn = timeClient.getFormattedTime();
    digitalWrite(led,HIGH);
    digitalWrite(buzzer, HIGH);
    delay(50);
    digitalWrite(buzzer, LOW);
    Firebase.setString(firebaseData, "/UID/"+k+"/uid" , uid);
    Firebase.setString(firebaseData, "/UID/"+k+"/time" , timeIn);
    
    digitalWrite(led,LOW);
    uidBefore = uid;
    Serial.println("uid: "+uid); 
    Serial.println("time: "+timeIn); 
    Serial.println();
    stt++;
    
    
  } 
	// Dump debug info about the card; PICC_HaltA() is automatically called
//	mfrc522.PICC_DumpToSerial(&(mfrc522.uid));
}
