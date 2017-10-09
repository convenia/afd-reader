![logo](afdreader.png)

---

Pacote para leitura de Arquivo Fonte de Dados (AFD).
Especificação do MTE referente a portaria [1.510/2009](http://www.trtsp.jus.br/geral/tribunal2/ORGAOS/MTE/Portaria/P1510_09.html).

---

[![StyleCI](https://styleci.io/repos/62637664/shield?branch=master)](https://styleci.io/repos/62637664)

---

## Arquivos suportados

- Arquivo-Fonte de Dados - AFD
- Arquivo-Fonte de Dados Tratado - AFDT
- Arquivo de Controle de Jornada para Efeitos Fiscais - ACJEF

## Utilização

```php
 use Convenia\AfdReader\AfdReader;

 $afdReader = new AfdReader('afdt_test.txt');
 $afdReader->getByUser();
```

## Métodos

- getByUser()
- getAll()

## Resposta

```php
Array
(
    [016428553393] => Array //PIS
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