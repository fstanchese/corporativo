(
Select 
  Boleto.Campus_Id                                                  as Campus_Id,
  Boleto_gnBoletoTi( Boleto.Id )                                    as BoletoTi_Origem,
  To_Char(Boleto.DtVencto, 'yyyymm')                                as MesContabil, 
  To_Char(Boleto.DtVencto, 'Month/yyyy')                            as MesFormatado, 
  Count( Boleto.BoletoTi_Id )                                       as Qtd, 
  To_Char( Sum( Boleto.Valor ) , '99G999G990D99' )                  as Principal, 
  To_Char( Sum( Recebimento_gnPrincipal(Boleto.Id) ) , '99G999G990D99' ) as PrincipalF, 
  To_Char( Sum( Recebimento.Multa ) , '99G999G990D99' )             as Multa, 
  To_Char( Sum( Recebimento.Mora ) , '99G999G990D99' )              as Mora, 
  To_Char( Sum( Recebimento.Valor ) , '99G999G990D99' )             as Total,
  Campus_gsRecognize(Boleto.Campus_Id)                              as Campus_Recognize
From 
  Boleto, 
  Recebimento 
Where 
  Boleto_gnBoletoTi ( Boleto.Id ) in ( 92200000000002 , 92200000000009 , 92200000000010 )
and 
  Recebimento.Boleto_Id = Boleto.id 
and 
  To_Date( Recebimento.DtPagto ) between to_Date( p_O_Data1 ) and To_Date( p_O_Data2 )
and
  (
    (
      Recebimento.CNAB_Origem_Id is not null 
    and 
      p_RecebimentoCNAB is not null 
    )     
  or
    ( 
      Recebimento.PostoBanc_Origem_Id is not null
    and
      p_RecebimentoPosto is not null
    )
  )
Group by  
  Boleto_gnBoletoTi( Boleto.Id ) ,
  To_Char(Boleto.DtVencto, 'yyyymm') , 
  To_Char(Boleto.DtVencto, 'Month/yyyy') ,
  Boleto.Campus_Id
)

union

(
Select 
  Boleto.Campus_Id                                                  as Campus_Id,
  Boleto_gnBoletoTi( Boleto.Id )                                    as BoletoTi_Origem,
  Boleto.Competencia                                                as MesContabil, 
  To_Char(to_Date(Boleto.Competencia,'yyyy/mm'),'Month/yyyy')       as MesFormatado, 
  Count( Boleto.BoletoTi_Id )                                       as Qtd, 
  To_Char( Sum( Boleto.Valor ) , '99G999G990D99' )                  as Principal, 
  To_Char( Sum( Recebimento_gnPrincipal(Boleto.Id) ) , '99G999G990D99' ) as PrincipalF, 
  To_Char( Sum( Recebimento.Multa ) , '99G999G990D99' )             as Multa, 
  To_Char( Sum( Recebimento.Mora ) , '99G999G990D99' )              as Mora, 
  To_Char( Sum( Recebimento.Valor ) , '99G999G990D99' )             as Total ,
  Campus_gsRecognize(Boleto.Campus_Id)                              as Campus_Recognize
From 
  Boleto, 
  Recebimento 
Where 
  Boleto_gnBoletoTi ( Boleto.Id ) in ( 92200000000003 , 92200000000013 , 92200000000015 )
and 
  Recebimento.Boleto_Id = Boleto.id 
and 
  To_Date( Recebimento.DtPagto ) between to_Date( p_O_Data1 ) and To_Date( p_O_Data2 ) 
and
  (
    (
      Recebimento.CNAB_Origem_Id is not null 
    and 
      p_RecebimentoCNAB is not null 
    )     
  or
    ( 
      Recebimento.PostoBanc_Origem_Id is not null
    and
      p_RecebimentoPosto is not null
    )
  )
Group by  
  Boleto_gnBoletoTi( Boleto.Id ) , 
  boleto.competencia, 
  To_Char(to_Date(Boleto.Competencia,'yyyy/mm'),'Month/yyyy') ,
  Boleto.Campus_Id
)

union

(
Select 
  Boleto.Campus_Id                                                  as Campus_Id,
  Boleto_gnBoletoTi( Boleto.Id )                                    as BoletoTi_Origem,
  To_Char(Recebimento.DtPagto, 'yyyymm')                            as MesContabil, 
  To_Char(Recebimento.DtPagto, 'Month/yyyy')                        as MesFormatado, 
  Count( Boleto.BoletoTi_Id )                                       as Qtd, 
  To_Char( Sum( Boleto.Valor ) , '99G999G990D99' )                  as Principal, 
  To_Char( Sum( Recebimento_gnPrincipal(Boleto.Id) ) , '99G999G990D99' ) as PrincipalF, 
  To_Char( Sum( Recebimento.Multa ) , '99G999G990D99' )             as Multa, 
  To_Char( Sum( Recebimento.Mora ) , '99G999G990D99' )              as Mora, 
  To_Char( Sum( Recebimento.Valor ) , '99G999G990D99' )             as Total ,
  Campus_gsRecognize(Boleto.Campus_Id)                              as Campus_Recognize
From 
  Boleto, 
  Recebimento 
Where 
  Boleto_gnBoletoTi( Boleto.Id ) in ( 92200000000004 , 92200000000005 , 92200000000006 , 92200000000008 , 92200000000014 )
and 
  Recebimento.Boleto_Id = Boleto.id 
and 
  To_Date( Recebimento.DtPagto ) between to_Date( p_O_Data1 ) and To_Date( p_O_Data2 ) 
and
  (
    (
      Recebimento.CNAB_Origem_Id is not null 
    and 
      p_RecebimentoCNAB is not null 
    )     
  or
    ( 
      Recebimento.PostoBanc_Origem_Id is not null
    and
      p_RecebimentoPosto is not null
    )
  )
Group by  
  Boleto_gnBoletoTi( Boleto.Id ) , 
  To_Char(Recebimento.DtPagto, 'yyyymm') , 
  To_Char(Recebimento.DtPagto, 'Month/yyyy') ,
  Boleto.Campus_Id
)
order by 2,1,3