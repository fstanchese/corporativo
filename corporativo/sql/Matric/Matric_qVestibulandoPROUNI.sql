select
  WPessoa.Nome as Nome,
  WPessoa.Codigo as RA,
  WPessoa.CPF as CPF,
  State_gsRecognize(Matric.State_Id) as Situacao,
  Curr.CurrNomeVest||' - '||Campus.Nome||' - '||Periodo.Nome as Curso
from
  Curr,
  Periodo,
  Campus,
  CurrOfe,
  TurmaOfe,
  WPessoa,
  Matric,  
  VestCla,
  VestOpcao,
  Vest
where
  Curr.Id = CurrOfe.Curr_Id
and
  Periodo.Id = CurrOfe.Periodo_Id
and
  Campus.Id = CurrOfe.Campus_Id
and  
  Currofe.Id = Turmaofe.CurrOfe_Id 
and 
  TurmaOfe.Id = Matric.TurmaOfe_Id
and
  (
    (   
        WPessoa.Id not in (select Matric.WPessoa_Id from Bolsa,CurrOfe,TurmaOfe,Matric where Bolsa.State_Id <> 3000000018002 and DtTermino>sysdate and Bolsa.BolsaTi_Id = 10600000000049 and Bolsa.WPessoa_Id = Matric.WPessoa_Id and CurrOfe.PLetivo_Id = nvl( p_PLetivo_Id ,0) and CurrOfe.Id = TurmaOfe.CurrOfe_Id and TurmaOfe.Id = Matric.TurmaOfe_Id and Matric.State_Id >= 3000000002002)
     and
        p_Matric_Gerada = 'on' 
     and 
        Matric.State_Id in (3000000002000,3000000002001) 
    ) 
  or
    p_Matric_Gerada is null
  )
and
  WPessoa.Id = Matric.WPessoa_Id
and
  Matric.Id = VestCla.Matric_Id  
and
  VestCla.VestOpcao_Id = VestOpcao.Id
and
  VestOpcao.Sequencia = 5
and  
  VestOpcao.Vest_Id = Vest.Id
and  
  Vest.WPleito_Id = nvl( p_WPleito_Id ,0)
order by
  Campus.Nome,Curr.CurrNomeVest,Periodo.Nome,WPessoa.Nome