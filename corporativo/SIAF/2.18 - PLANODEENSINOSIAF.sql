drop table usjt.PlanoDeEnsinoSIAF;

create table usjt.PlanoDeEnsinoSIAF
(
COD_PLANO_AULA_EXT			VARCHAR2(100),
COD_TURMA_EXT				VARCHAR2(100),
DSC_TEMA_EXT				VARCHAR2(4000),
COD_PLANO_CURSO_EXT			VARCHAR2(200),
COD_PERIODO_LETIVO_EXT		VARCHAR2(100),
COD_DISCIPLINA_EXT			VARCHAR2(100),
DSC_METODOLOGIA				VARCHAR2(4000),
DSC_OBJETIVO				VARCHAR2(4000),
DSC_ATIV_DISCENTE			VARCHAR2(4000),
COD_CONTEUDO_EXT			VARCHAR2(100),
COD_CONTEUDO_PAI_EXT		VARCHAR2(100),
DSC_CONTEUDO				VARCHAR2(500),
ORD_CONTEUDO				NUMBER(4),
COD_REFERENCIA_EXT			VARCHAR2(100),
COD_TPO_REFERENCIA			NUMBER(10),
DSC_REFERENCIA				VARCHAR2(4000),
COD_EMENTA_EXT				VARCHAR2(100),
DSC_EMENTA					VARCHAR2(4000),
DAT_INI_EMENTA				DATE,
DAT_FIM_EMENTA				DATE
) ;

select
  'INSERT INTO usjt.PlanoDeEnsinoSIAF (COD_PLANO_AULA_EXT,COD_TURMA_EXT,DSC_TEMA_EXT,COD_PLANO_CURSO_EXT,COD_PERIODO_LETIVO_EXT,COD_DISCIPLINA_EXT,DSC_METODOLOGIA,DSC_OBJETIVO,DSC_ATIV_DISCENTE,COD_CONTEUDO_EXT,COD_CONTEUDO_PAI_EXT,DSC_CONTEUDO,ORD_CONTEUDO,COD_REFERENCIA_EXT,COD_TPO_REFERENCIA,DSC_REFERENCIA,COD_EMENTA_EXT,DSC_EMENTA,DAT_INI_EMENTA,DAT_FIM_EMENTA)'||
  ' values ('||to_char(wocorrass.id)||','''||nomenet||''','||translate(PagtoUso_gnValorServico(WOcorrAss.Id),',','.')||',null,null,null,null,null,null,null,null);'
from
  conteudo,
  conteudoi
where
  conteudo.conteudoi_id = conteudoi.id
order by nomenet