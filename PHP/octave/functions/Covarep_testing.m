function [PS,NAQ,CPP,H1H2,PSP,QOQ,HRF,MDQ,RDS] = Covarep_testing
audio = char(argv()(1, :));
rec_id = char(argv()(2, :));
%dodawanie sciezek, itp.
current_directory = fileparts(mfilename('fullpath'));
entries = strsplit(genpath(current_directory), pathsep);
addpath(strjoin(entries, pathsep));
more off;
pkg load tsa;
pkg load signal;
    
%Sta�e
F0min = 50; 
F0max = 550; 
frame_shift = 10; 

% wczytanie wav
[x,fs] = audioread(audio);
 x=x(:,1);
 
% Byc moze do wywalenia
 polarity = polarity_reskew(x,fs);
 x=polarity*x;

%Parametryzacja
[srh_f0,srh_vuv,srh_vuvc,srh_time] = pitch_srh(x,fs,F0min,F0max,frame_shift);
[max_voiced_freq] = maximum_voiced_frequency(x,fs,srh_f0.*srh_vuv,srh_time);
se_gci = se_vq(x,fs,median(srh_f0));        
res = maxlpresidual(x,fs,round(fs/1000)+2);
m = mdq(res,fs,se_gci); % MDQ
ps = peakslope(x,fs);   % PS
[gf_iaif,gfd_iaif] = iaif_ola(x,fs);    
[naq,qoq,h1h2,hrf,psp] = get_vq_params(gf_iaif,gfd_iaif,fs,se_gci); % NAQ, QOQ, H1H2, HRF, PSP
cppv = cpp( x, fs, 1, 'mean' ); % CPP
srh_f0(find(srh_f0==0)) = 100;
opt = sin_analysis();
opt.fharmonic  = true;
opt.use_ls     = false;
opt.debug = 0;
frames = sin_analysis(x, fs, [srh_time(:),srh_f0(:)], opt);
rds = rd_msp(frames, fs); % RDS

%Wyniki
a=mean(ps);
b=mean(naq);
c=mean(cppv);
d=mean(h1h2);
e=mean(psp);
f=mean(qoq);
g=mean(hrf);
h=mean(m);
i=mean(rds);
PS=a(2);
NAQ=b(2);
CPP=c(2);
H1H2=d(2);
PSP=e(2);
QOQ=f(2);
HRF=g(2);
MDQ=h(2);
RDS=i(2);

parametry = [CPP, H1H2, HRF, NAQ, PSP, QOQ, MDQ, PS, RDS];
% zmienic nazwe zeby zawierala id = drugi argument z funkcji
csvwrite(strcat("temp-params_", rec_id, ".csv"), parametry);
end