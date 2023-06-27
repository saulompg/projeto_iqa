# Projeto AAGA2O - Framework para monitoramento de água doce

> Nosso projeto objetiva mensurar a qualidade de um corpo de água doce através de medições de variáveis físicas e químicas in loco, e processadas na nuvem.

## Estação de extração e transmissão de dados
A nossa estação de extração ou coleta de dados consiste em um módulo computacional de baixo custo com uma arquitetura aberta, um conjunto de sensores e o nosso módulo de transmissão/recepção wifi.

## Gateway de comunicação
O nosso gateway de comunicação se comunica com a estação de extração de dados, possibilitando que os dados coletados possam ser transmitidos e armazenados – através de uma aplicação WEB, desenvolvida na linguagem PHP – no Banco de Dados.
Além disso, ele é responsável por realizar a integração com a aplicação mobile. Através de uma SELECT Query, os dados necessários para calcular o Índice de Qualidade da Água (IQA) são buscados no Banco. Os dados são processados e transformados em um índice inteligível que é acessado pelo App.

## Servidor em nuvem

## Aplicação mobile
A aplicação mobile foi desenvolvida com a linguagem Javascript e o framework React Native. Visando uma aplicação voltada à usabilidade do usuário e que atendesse nosso objetivo de passar a informação de maneira clara e objetiva, desenvolvemos uma interface simples e amigável, que apresenta o resultado do índice de qualidade da água através de um medidor radial, categorizado e classificado em faixas de qualidade, distinguíveis pela cor e uma breve descrição acerca do seu estado.
