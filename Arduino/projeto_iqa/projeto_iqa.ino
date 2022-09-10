#include <SPI.h>
#include <Ethernet.h>

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0xFF };
IPAddress server_ip;
EthernetClient cliente;
byte servidor[] = { 192, 168, 1, 3 };
#define portaHTTP 80

#define POT A0

float temperature;
float lastTemperature = 0;

void setup() {
  Serial.begin(115200); 
  while(!Serial);
  Ethernet.begin(mac);
  while(!Ethernet.begin(mac))
    Serial.println("Falha a conectar a rede");
  Serial.print("Conectado a rede, no ip: ");
  Serial.println(Ethernet.localIP());
}

void loop() {
  temperature = ( float(analogRead(POT)) / 1023 ) / 0.010;
  Serial.println("A temperatura medida é: " + (String)temperature + "°C");

  if (temperature != lastTemperature){
    lastTemperature = temperature;

    if(cliente.connect(servidor, portaHTTP)) {
      
      //http://192.168.1.3/projeto_iqa/insertData.php?t=null
      
      cliente.print("GET /projeto_iqa/insertData.php");
      cliente.print("?t=");
      cliente.print(temperature);
      cliente.println(" HTTP/1.0");
      cliente.println("Host: 192.168.1.3");
      cliente.println("Connection: close");
      cliente.println();
    
    } else {
      Serial.println("Falha na conexao com o servidor");
    }
  }
  
  delay(5000);
}
