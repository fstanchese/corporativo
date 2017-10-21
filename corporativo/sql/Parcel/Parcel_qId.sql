select
  Parcel.*,
  WPessoa_gsRecognize(WPessoa_Id)           as WPessoa_Aluno,
  WPessoa_gnCodigo(WPessoa_Id)              as Codigo_Aluno,
  WPessoa_gsRetCPF(WPessoa_Id)              as CPF_Aluno,
  WPessoa_gsRecognize(WPessoa_Avalista_Id)  as WPessoa_Avalista,
  WPessoa_gsRetCPF(WPessoa_Avalista_Id)     as CPF_Avalista,
  WPessoa_gnCodigo(WPessoa_Avalista_Id)     as Codigo_Avalista,
  WPessoa_gsRecognize(WPessoa_Confessor_Id) as WPessoa_Confessor,
  WPessoa_gsRetCPF(WPessoa_Confessor_Id)    as CPF_Confessor,
  WPessoa_gnCodigo(WPessoa_Confessor_Id)    as Codigo_Confessor,
  WPessoa_gsRecognize(WPessoa_ConjAval_Id)  as WPessoa_ConjAvalista
from
  Parcel
where
  id = nvl( p_Parcel_Id , 0)