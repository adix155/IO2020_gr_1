function [a,b,c,d,e,f,g,h] = Covarep(audio)
clear all;
startup;
F0min = 50; % Minimum F0 set to 80 Hz
F0max = 550; % Maximum F0 set to 80 Hz
frame_shift = 10; % Frame shift in ms

% Load soundfile
[x,fs] = audioread(audio);
 x=x(:,1);
% Check the speech signal polarity
 polarity = polarity_reskew(x,fs);
 x=polarity*x;
% Extract the pitch and voicing information
[srh_f0,srh_vuv,srh_vuvc,srh_time] = pitch_srh(x,fs,F0min,F0max,frame_shift);
% Extract the maximum voiced frequency
[max_voiced_freq] = maximum_voiced_frequency(x,fs,srh_f0.*srh_vuv,srh_time);
se_gci = se_vq(x,fs,median(srh_f0));           % SE-VQ
res = maxlpresidual(x,fs,round(fs/1000)+2);
m = mdq(res,fs,se_gci); % Maxima dispersion quotient measurement
ps = peakslope(x,fs);   % peakSlope extraction
[gf_iaif,gfd_iaif] = iaif_ola(x,fs);    % Glottal flow (and derivative) by the IAIF method
[NAQ,QOQ,H1H2,HRF,PSP] = get_vq_params(gf_iaif,gfd_iaif,fs,se_gci); % Estimate conventional glottal parameters
CPPv = cpp( x, fs, 1, 'mean' );

a=mean(ps);
b=mean(NAQ);
c=mean(CPPv);
d=mean(H1H2);
e=mean(PSP);
f=mean(QOQ);
g=mean(HRF);
h=mean(m);
end