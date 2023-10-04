<?php

//export word 

header("Content-type: application/vnd.ms-word");
header("Content-Disposition:attachment; filename=LazarGalic104/20author.doc");

$word = "<table>
            <thead>
                <tr>
                    <th><b>Lazar Galic</b> 104/20</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> 
                    My name is Lazar Galic. I was born in march of 2002 and I study Internet Technologies at the 'ICT College' in Belgrade, Serbia.
                    I went to high school of electrotechnics 'Nikola Tesla' and graduated as a electrotechnician of multimedia. I came across web design
                    and internet technologies in high school for the first timeand it became one of my interests. My dream is to work for a successful company until
                    I acquire some experience in order to hopefully start my own company some day.
                    </td>
                </tr>
            </tbody>
        </table>";
echo $word;