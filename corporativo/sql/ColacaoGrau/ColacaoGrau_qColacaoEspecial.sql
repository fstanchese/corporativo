select
  curr.currnomehist                   as nomecurso,
  wpessoa.nome                        as nomealuno,
  turmaofe_gsretcodturma(turmaofe_id) as turma,
  wpessoa.rgrneformatado                      as rg,
  to_char(tempcolacao.dtcolacao,'dd-mm-yyyy') as dtcolacao,
  wpessoa.codigo                      as RA,
  WPessoa_gsRecognize(WPessoa_Pres_Id) as Presidente,
  ColacaoGrau.Localizacao              as Local,
  ColacaoGrau.Horario                  as Horario,
  Matric.WPessoa_Id                    as WPessoa_Id,
  pletivo.nome                         as pletivo,
  WPessoa_Pres_Id                      as WPessoa_Pres_Id
from
  pletivo,
  wpessoa,
  tempcolacao,
  matric,
  currofe,
  curr,
  turmaofe,
  colacaograu
where
  pletivo.id = currofe.pletivo_id
and
  wpessoa.id = matric.wpessoa_id
and
  curr.id = currofe.curr_id
and
  turmaofe.currofe_id = currofe.id
and
  matric.turmaofe_id = turmaofe.id
and
  tempcolacao.matric_id = matric.id
and
  tempcolacao.dtcolacao = p_ColacaoGrau_DtColacao
and
  colacaograu.dtcolacao = p_ColacaoGrau_DtColacao
and
  colacaograu.colacaograuti_id = 124200000000002
order by NomeCurso, PLetivo, NomeAluno 