(
select 
  Matric.Wpessoa_Id,
  BolsaTi_Id,
  Bolsa_gnPercentual(nvl(bolsa.id,0),to_char( to_Date( nvl ( p_O_Data , sysdate ) ),'mm'),0) as Percentual,
  BolsaTi.Nome as BolsaTi_Nome,
  WPessoa.Codigo as WPessoa_Codigo,
  WPessoa.Nome as WPessoa_Nome,
  translate(upper(WPessoa.nome),'ацимстзг','AAEIOOUC') as NomeOrdem,
  Bolsa.Id as Bolsa_Id
from 
  Matric,
  bolsa,
  bolsati,
  WPessoa
where
  Matric.Wpessoa_Id = WPessoa.Id
and
  Mensalidade = 'on'
and
  Bolsa.BolsaTi_Id = BolsaTi.Id
and
  to_Date( p_O_Data ) between to_Date(bolsa.dtinicio) and to_Date(bolsa.dttermino)
and
  Bolsa.State_id <> 3000000018002
and
  Matric.Id = Bolsa.Matric_Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in $v_State
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
)
union
(
select 
  Matric.Wpessoa_Id,
  BolsaTi_Id,
  Bolsa_gnPercentual(nvl(bolsa.id,0),to_char( to_Date( nvl ( p_O_Data , sysdate ) ) ,'mm'),0) as Percentual,
  BolsaTi.Nome as BolsaTi_Nome,
  WPessoa.Codigo as WPessoa_Codigo,
  WPessoa.Nome as WPessoa_Nome,
  translate(upper(WPessoa.nome),'ацимстзг','AAEIOOUC') as NomeOrdem,
  Bolsa.Id as Bolsa_Id
from 
  Matric,
  bolsa,
  bolsati,
  WPessoa
where
  Matric.Wpessoa_Id = WPessoa.Id
and
  Mensalidade = 'on'
and
  Bolsa.BolsaTi_Id = BolsaTi.Id
and
  to_Date( p_O_Data ) between to_Date(bolsa.dtinicio) and to_Date(bolsa.dttermino)
and
  Bolsa.Matric_Id is null
and
  Bolsa.State_id <> 3000000018002
and
  Matric.WPessoa_Id = Bolsa.WPessoa_Id (+)
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in $v_State
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
)
union
(
select 
  Matric.Wpessoa_Id,
  0,
  0,
  '',
  WPessoa.Codigo as WPessoa_Codigo,
  WPessoa.Nome as WPessoa_Nome,
  translate(upper(WPessoa.nome),'ацимстзг','AAEIOOUC') as NomeOrdem,
  0 as Bolsa_Id
from 
  Matric,
  WPessoa
where
  not exists ( select
                 bolsa.id
               from
                 bolsa,
                 bolsati
               where
                 Mensalidade = 'on'
               and
                 Bolsa.BolsaTi_Id = BolsaTi.Id
               and
                 to_Date( p_O_Data ) between to_Date(bolsa.dtinicio) and to_Date(bolsa.dttermino)
               and
                 Matric.WPessoa_Id = Bolsa.WPessoa_Id
  )
and
  Matric.Wpessoa_Id = WPessoa.Id
and
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in $v_State
and
  Matric.TurmaOfe_Id = nvl( p_TurmaOfe_Id ,0)
)
Order by 1