// ########## recebe caractere "a" pela serial e abre roleta #####################
// Ligar pino 13 no módulo de relé 


const int ledPin=13;
String msg;

void setup() {
  Serial.begin(9600);
  pinMode(ledPin,OUTPUT);
  digitalWrite(ledPin,HIGH);
}

void loop() {
  if (Serial.available()) {
       delay(10);
       msg=(char)Serial.read();
       if(msg=="a"){ //Abre roleta 
           Serial.println("teste");
           digitalWrite(ledPin,LOW);
           delay(2000);
           digitalWrite(ledPin,HIGH);
           delay(2000);
       }
        if(msg=="f"){ //Fecha roleta 
           Serial.println("teste");
           digitalWrite(ledPin,LOW);
           delay(2000);
           digitalWrite(ledPin,HIGH);
           delay(2000);
       }
    }
    Serial.flush();
  delay(500);
}
