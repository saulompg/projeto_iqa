#include <SPI.h>
#include <Ethernet.h>

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0xFF };
IPAddress server_ip;
EthernetClient cliente;

#define server "projeto-iqa.000webhostapp.com"
#define portaHTTP 80

float temperatura, ph, turbidez, oxigenio_d, fosfato, nitrato, dbo, coliformes, residuo_t;

void setup() {
  Serial.begin(115200); 
  while(!Serial);
  Serial.println("Serial Iniciado");
  Ethernet.begin(mac);
  while(!Ethernet.begin(mac));
  Serial.println("Ethernet Iniciado");
  Serial.println(Ethernet.localIP());
  delay(32);
}

void loop() {
  
  Serial.println("----- INSERIR DADOS -----");
  
  Serial.print("Temperatura: ");
  while(true){
    if(Serial.available()){
      temperatura = Serial.parseFloat();
      Serial.println((String)temperatura+" °C");
      break;
    }
  }
  
  delay(100);
  
  Serial.print("pH: ");
  while(true){
    if(Serial.available()){
      ph = Serial.parseFloat();
      Serial.println((String)ph);
      break;
    }
  }
  
  delay(100);
  
  Serial.print("Turbidez: ");
  while(true){
    if(Serial.available()){
      turbidez = Serial.parseFloat();
      Serial.println((String)turbidez+" NTU");
      break;
    }
  }
  
  delay(100);
  
  Serial.print("Oxigênio Dissolvido: ");
  while(true){
    if(Serial.available()){
      oxigenio_d = Serial.parseFloat();
      Serial.println((String)oxigenio_d+"%");
      break;
    }
  }
  
  delay(100);
    
  Serial.print("Fosfato: ");
  while(true){
    if(Serial.available()){
      fosfato = Serial.parseFloat();
      Serial.println((String)fosfato+" mg/l");
      break;
    }
  }
  
  delay(100);
  
  Serial.print("Nitrato: ");
  while(true){
    if(Serial.available()){
      nitrato = Serial.parseFloat();
      Serial.println((String)nitrato+" mg/l");
      break;
    }
  }
  
  delay(100);
  
  Serial.print("DBO: ");
  while(true){
    if(Serial.available()){
      dbo = Serial.parseFloat();
      Serial.println((String)dbo+" mg/l");
      break;
    }
  }
  
  delay(100);
  
  Serial.print("Coliformes Termotolerantes: ");
  while(true){
    if(Serial.available()){
      coliformes = Serial.parseFloat();
      Serial.println((String)coliformes+" Colonies/100ml");
      break;
    }
  }
 
  delay(100);
  
  Serial.print("Residuo Total: ");
  while(true){
    if(Serial.available()){
      residuo_t = Serial.parseFloat();
      Serial.println((String)residuo_t+" mg/l");
      break;
    }
    
  }
  
  delay(100);
    
  if(cliente.connect(server, portaHTTP)) {

    //https://projeto-iqa.000webhostapp.com/insertData.php/?temperatura=X&ph=X&turbidez=X&oxigenio_d=X&fosfato=X&nitrato=X&dbo=X&coliformes=X&residuo_t=X
    cliente.print("GET /insertData.php");
    cliente.print("?temperatura=");
    cliente.print(temperatura);
    cliente.print("&ph=");
    cliente.print(ph);
    cliente.print("&turbidez=");
    cliente.print(turbidez);
    cliente.print("&oxigenio_d=");
    cliente.print(oxigenio_d);
    cliente.print("&fosfato=");
    cliente.print(fosfato);
    cliente.print("&nitrato=");
    cliente.print(nitrato);
    cliente.print("&dbo=");
    cliente.print(dbo);
    cliente.print("&coliformes=");
    cliente.print(coliformes);
    cliente.print("&residuo_t=");
    cliente.print(residuo_t);
    cliente.println(" HTTP/1.0");
    cliente.println("Host: projeto-iqa.000webhostapp.com");
    cliente.println("Connection: close");
    cliente.println();
    Serial.println("Os dados foram registrados no Banco");

  } else Serial.println("Falha na conexao com o servidor");
  
  delay(5000);
}
