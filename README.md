# AfdReader - AFD and AFDT Read Class

## How to use:

```
 use Convenia\AfdReader\AfdReader;

 $objAfdReader = new AfdReader('afdt_test.txt');
 $array = $objAfdReader->getByUser();
```

 ## Response example:

```
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