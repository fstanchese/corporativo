Select
  Boleto.Boletoti_id                                     as Id ,
  BoletoTi_gsRecognize( Boleto.BoletoTi_Id )             as Recognize,
  Count( Boleto.BoletoTi_Id )                            as Qtd,
  To_Char( Sum( Recebimento.Valor ) , '99G999G990D99' )  as Total,
  Campus_gsRecognize(Campus_Id)                          as Campus_Recognize,
  Substr(PostoBanc.IP, 1, 4)                             as Campus_Posto
From
  Boleto,
  Recebimento,
  PostoBanc
Where
  Recebimento.Boleto_Id = Boleto.id
and
  Recebimento.PostoBanc_Origem_Id = PostoBanc.Id
and
  To_Date( Recebimento.DtPagto ) between to_Date( p_O_Data1 ) and To_Date( p_O_Data2 )
Group by 
  Substr(PostoBanc.IP, 1, 4), Boleto.BoletoTi_Id, Boleto.Campus_Id
order by 6,2