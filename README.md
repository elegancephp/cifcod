# cifcod
Aplica cifra e codificação em strings

---
## Classes
As classes fornecidas são classes de objetos e podem ser encontradas dentro do namespace **elegance**

    \elegance\Cif::class
    \elegance\Cod::class

---
## Cod
Transforma uma string em um codigo de 34 caracteres
Para se utilizar a classe **Cod**, deve-se criar um novo objeto, ou utilizar os helpers para codificar com o objeto padrão.

    $cod = new \elegance\Cod('chave');

Para altear o objeto de codificação padrão, pode-se passar um objeto ou uma chave de codificação para o metodo static _def_

    \elegance\Cod::_def_('chave');
    \elegance\Cod::_def_(new \elegance\cod('chave'));

**Aplicando codificação**
Pode-se aplicar a codificação utilizando o metodo **on** de um objeto de codificação. 
Pode-se utilizar o helper **cod_on** para utilizar o objeto padrão

    cod_on('string');
    $cod->on('string');

**Revertendo codificação**
Pode-se reverter os efeitos da codificação utilizando o metodo **off** de um objeto de codificação. 
Pode-se utilizar o helper **cod_off** para utilizar o objeto padrão

    cod_off('string');
    $cod->off('string');

 > Reverter a codificação **NÃO** retorna a string original, mas sim o hash MD5 da string original

**Validação**
Pode-se verificar se uma string é uma string codificada utilizando o metodo **check**
Pode-se utilizar o helper **cod_check** para utilizar o objeto padrão

    cod_check('string1');
    $cod->check('string1');

 **Comparaçõeos**
Pode-se comparar a codificação de duas strings utilizando o metodo **compare**
Pode-se utilizar o helper **cod_compare** para utilizar o objeto padrão
Este modo compara a codificação de duas strings, mesmo que não tenham sido condificadas.

    cod_compare('string1','string2');
    $cod->compare('string1','string2');

---
## Cif
Transforma uma cifra reversivel a uma string
Para se utilizar a classe **Cif**, deve-se criar um novo objeto, ou utilizar os helpers para cifrar com o objeto padrão.
A classe utiliza um arquivo de certificado para cifras as strings, o caminho para esse arquivo deve ser informado na criação do objeto.
Caso nenhum caminho for informado, ou caso seja informado um caminho invalido, o objeto usará o certificado padrão.

    $cif = new \elegance\Cif([caminho do arquivo .crt]);

Para altear o objeto de codificação padrão, pode-se passar um objeto ou uma chave de codificação para o metodo static _def_

    \elegance\Cif::_def_([caminho do arquivo .crt]);
    \elegance\Cif::_def_(new \elegance\cif([caminho do arquivo .crt]));

**Aplicando cifra**
Pode-se aplicar a cifra utilizando o metodo **on** de um objeto de cifra. 
Pode-se utilizar o helper **cif_on** para utilizar o objeto padrão

    cif_on('string');
    $cif->on('string');

> Caso nenhuma chave de cifra seja fornecedia, configuração ENV **cifKey** será utilizada.
> Caso nenhuma chave de cifra seja fornecedia, e não exista a configuração ENV **cifKey**, uma chave aleatória será utilizada

**Revertendo cifra**
Pode-se reverter os efeitos da cifra utilizando o metodo **off** de um objeto de cifra. 
Pode-se utilizar o helper **cif_off** para utilizar o objeto padrão

    cif_off('string');
    $cif->off('string');

**Validação**
Pode-se verificar se uma string é uma string cifrada utilizando o metodo **check**
Pode-se utilizar o helper **cif_check** para utilizar o objeto padrão

    cif_check('string1');
    $cod->check('string1');

 **Comparaçõeos**
Pode-se comparar duas strings utilizando o metodo **compare**
Pode-se utilizar o helper **cif_compare** para utilizar o objeto padrão
Este modo compara duas strings estando elas cifradas ou não

    cif_compare('string1','string2');
    $cod->compare('string1','string2');