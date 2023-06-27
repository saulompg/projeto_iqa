# Projeto AAGA2O - Framework para monitoramento de água doce

> O projeto AAGA2O objetiva mensurar a qualidade de um corpo de água doce através de medições de variáveis físicas e químicas in loco, e processadas na nuvem.
> A estação Íris comunica-se com o Banco de Dados através de um gateway de comunicação, registrando os dados coletados.
> Os dados gerados são tratados implementando o cálculo do Índice de Qualidade da Água (IQA) - desenvolvido pela National Sanitation Foundation (NSF).
> O índice é transmitido ao aplicativo mobile *AAGA2O* para ser acessado de modo inteligível pelo usuário.

## Íris - Estação de extração e transmissão de dados
A nossa estação de extração ou coleta de dados é denominada Íris, termo de etimologia grega e origem mítica que significa mensageiro dos deuses ou arco-íris. A estação Íris consiste na integração de um módulo computacional de baixo custo e arquitetura aberta (plataforma Arduino), um conjunto de sensores e o módulo de transmissão/recepção wifi.
Os sensores realizam o monitoramento dos parâmetros e a coleta dos dados do ambiente. Os paramêtros observados para o cálculo do IQA são: Temperatura, pH, Oxigênio Dissolvido, Demanda Bioquímica de Oxigênio (DBO), Fostafo, Nitrato, Coliformes Termotoletantes, Turbidez e Sólidos totais dissolvidos

## Gateway de comunicação
O nosso gateway de comunicação é chamado de Torre. Ele estabelece a conexão com a estação Ísis, possibilitando que os dados coletados possam ser transmitidos e armazenados – através de uma aplicação WEB, desenvolvida na linguagem PHP – no Banco de Dados.
Além disso, ele é responsável por realizar a integração com a aplicação mobile. Através de uma SELECT Query, os dados necessários para calcular o IQA são buscados no Banco. Os dados são processados e transformados em um índice inteligível que é acessado pelo App.

## Servidor em nuvem
Os dados coletados são hospedados em um servidor na nuvem, possibilitando o acesso remoto aos dados.

## Aplicação mobile
A aplicação mobile foi desenvolvida com a linguagem Javascript e o framework React Native. Visando uma aplicação voltada à usabilidade do usuário e que atendesse nosso objetivo de passar a informação de maneira clara e objetiva, desenvolvemos uma interface simples e amigável, que apresenta o resultado do índice de qualidade da água através de um medidor radial, categorizado e classificado em faixas de qualidade, distinguíveis pela cor e uma breve descrição acerca do seu estado.
