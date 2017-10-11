![logo](afdreader.png)

---

Pacote para leitura de Arquivo Fonte de Dados (AFD).
Especificação do MTE referente a portaria [1.510/2009](http://www.trtsp.jus.br/geral/tribunal2/ORGAOS/MTE/Portaria/P1510_09.html).

---
[![Build Status](https://travis-ci.org/convenia/afd-reader.svg?branch=master)](https://travis-ci.org/convenia/afd-reader)
[![StyleCI](https://styleci.io/repos/62637664/shield?branch=master)](https://styleci.io/repos/62637664)
[![Code Climate](https://codeclimate.com/github/convenia/afd-reader/badges/gpa.svg)](https://codeclimate.com/github/convenia/afd-reader)
[![Total Downloads](https://poser.pugx.org/convenia/afd-reader/downloads)](https://packagist.org/packages/convenia/afd-reader)
---

## Arquivos suportados

- Arquivo-Fonte de Dados - AFD
- Arquivo-Fonte de Dados Tratado - AFDT
- Arquivo de Controle de Jornada para Efeitos Fiscais - ACJEF

## Métodos

- getByUser()
- getAll()

## Utilização

O AfdReader pode ser instanciado informando apenas o caminho do arquivo, neste caso ele tentará descobrir o tipo do arquivo:
```php
 use Convenia\AfdReader\AfdReader;

 $afdReader = new AfdReader('afdt_test.txt');
```

Informando o tipo do arquivo:
```php
 use Convenia\AfdReader\AfdReader;

 $afdReader = new AfdReader('afdt_test.txt', 'Afdt');
```

Obter informações agrupados por NIS/PIS:
```php
 $afdReader->getByUser();
```

```php
Array
(
    [62915959739] => Array //PIS
        (
            [20052015] => Array //DDMMYYYY
                (
                    [01] => Array //ORDER
                        (
                            [0] => Array //ENTRADA
                                (
                                    [sequency] => 000000002
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 09:00:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Entrada
                                    [type] => Original
                                )

                            [1] => Array //SAIDA
                                (
                                    [sequency] => 000000003
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 12:04:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Saída
                                    [type] => Original
                                )

                        )

                    [02] => Array //ORDER
                        (
                            [0] => Array //ENTRADA
                                (
                                    [sequency] => 000000004
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 13:14:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Entrada
                                    [type] => Original
                                )

                            [1] => Array //SAIDA
                                (
                                    [sequency] => 000000005
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 18:07:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Saída
                                    [type] => Original
                                )

                        )

                )

        )

)
```

Obter as ocorrências de um NIS/PIS:
```php
 $afdReader->getByUser(62915959739);
```

```php
[20052015] => Array //DDMMYYYY
                (
                    [01] => Array //ORDER
                        (
                            [0] => Array //ENTRADA
                                (
                                    [sequency] => 000000002
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 09:00:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Entrada
                                    [type] => Original
                                )

                            [1] => Array //SAIDA
                                (
                                    [sequency] => 000000003
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 12:04:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Saída
                                    [type] => Original
                                )

                        )

                    [02] => Array //ORDER
                        (
                            [0] => Array //ENTRADA
                                (
                                    [sequency] => 000000004
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 13:14:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Entrada
                                    [type] => Original
                                )

                            [1] => Array //SAIDA
                                (
                                    [sequency] => 000000005
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 18:07:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Saída
                                    [type] => Original
                                )

                        )

                )
```

Obter as ocorrências de um NIS/PIS no período especificado:
```php
 $afdReader->getByUser(62915959739, ['from' => '2015-05-20', 'to' => '2015-05-20']);
```

```php
[20052015] => Array //DDMMYYYY
                (
                    [01] => Array //ORDER
                        (
                            [0] => Array //ENTRADA
                                (
                                    [sequency] => 000000002
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 09:00:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Entrada
                                    [type] => Original
                                )

                            [1] => Array //SAIDA
                                (
                                    [sequency] => 000000003
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 12:04:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Saída
                                    [type] => Original
                                )

                        )

                    [02] => Array //ORDER
                        (
                            [0] => Array //ENTRADA
                                (
                                    [sequency] => 000000004
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 13:14:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Entrada
                                    [type] => Original
                                )

                            [1] => Array //SAIDA
                                (
                                    [sequency] => 000000005
                                    [dateTime] => DateTime Object
                                        (
                                            [date] => 2015-05-20 18:07:00.000000
                                            [timezone_type] => 3
                                            [timezone] => America/Sao_Paulo
                                        )

                                    [reason] => 

                                    [direction] => Saída
                                    [type] => Original
                                )

                        )

                )
```

Obter as informações de todos os registros:
```php
 $afdReader->getAll();
```

```php
Array
(
    [header] => Array
        (
            [sequency] => 000000001
            [type] => 1
            [entityType] => CNPJ
            [entityNumber] => 32041763000177
            [cei] => 000000000000
            [name] => NOME DA EMPRESA - LTDA ME                                                                                                                    
            [startDate] => 20052015
            [endDate] => 20092015
            [generationDate] => DateTime Object
                (
                    [date] => 2015-09-21 09:57:59.000000
                    [timezone_type] => 3
                    [timezone] => America/Sao_Paulo
                )

            [generationTime] => Array
                (
                    [hour] => 10
                    [minute] => 43
                )

        )

    [trailer] => Array
        (
            [sequency] => 000011305
            [type] => 9
        )

    [detail] => Array
        (
            [62915959739] => Array
                (
                    [20052015] => Array
                        (
                            [01] => Array
                                (
                                    [0] => Array
                                        (
                                            [sequency] => 000000002
                                            [dateTime] => DateTime Object
                                                (
                                                    [date] => 2015-05-20 09:00:00.000000
                                                    [timezone_type] => 3
                                                    [timezone] => America/Sao_Paulo
                                                )

                                            [reason] => 

                                            [direction] => Entrada
                                            [type] => Original
                                        )

                                    [1] => Array
                                        (
                                            [sequency] => 000000003
                                            [dateTime] => DateTime Object
                                                (
                                                    [date] => 2015-05-20 12:04:00.000000
                                                    [timezone_type] => 3
                                                    [timezone] => America/Sao_Paulo
                                                )

                                            [reason] => 

                                            [direction] => Saída
                                            [type] => Original
                                        )

                                )

                            [02] => Array
                                (
                                    [0] => Array
                                        (
                                            [sequency] => 000000004
                                            [dateTime] => DateTime Object
                                                (
                                                    [date] => 2015-05-20 13:14:00.000000
                                                    [timezone_type] => 3
                                                    [timezone] => America/Sao_Paulo
                                                )

                                            [reason] => 

                                            [direction] => Entrada
                                            [type] => Original
                                        )

                                    [1] => Array
                                        (
                                            [sequency] => 000000005
                                            [dateTime] => DateTime Object
                                                (
                                                    [date] => 2015-05-20 18:07:00.000000
                                                    [timezone_type] => 3
                                                    [timezone] => America/Sao_Paulo
                                                )

                                            [reason] => 

                                            [direction] => Saída
                                            [type] => Original
                                        )

                                )

                        )
                )

        )

)
```